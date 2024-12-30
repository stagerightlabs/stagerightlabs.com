---
title: Using Lumen and Mandrill to Process Incoming Mail
date: 2015-05-03
summary: Have you ever wanted to automate data entry via email? We can use Laravel Lumen and Mandrill to set up a very simple service for parsing incoming mail and saving important data.
tags:
    - E-Mail
    - Laravel
    - Lumen
---

One of my clients has a WordPress site which makes use of several different contact forms. Powered by the [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) plugin, they send their data to an email address when the user submits the form. Recently my client decided that they wanted to send a "Thank you" email as a response to each person who filled out a particular form, and they asked me to set that up for them. I have been using Mandrill for some of my larger applications, and it seemed to me that by combining the Mandrill Incoming Mail API with Lumen, the micro-framework from Laravel, setting up a micro-service to solve this problem would be very easy. Here is how I did it:

First we should create a subdomain on the client's main site, specifically for this project: `inbox.clientdomain.com`. This is where we will set up our Lumen Application. Next we need to point the MX records for that subdomain to Mandrill. Within your Mandrill dashboard, go to the "Inbound" section and add your new domain to the domain list there. Once that is done Mandrill will provide you with the necessary MX details, and you can also verify that you MX records have been set appropriately. Next, click on the "routes" button for your new domain. When email is received at `inbox.clientdomain.com` we can assign the URL we want Mandrill to send it to. For this project I set up all mail received at `"contact@inbox.clientdomain.com"` to be sent to the URL `"http://inbox.clientdomain.com/contact"`. We could set up other email addresses on that domain to be sent to other places, but this is all we will need for now.

Here is the basic structure of what our micro-service will do:

- Receive the POST data from Mandrill containing the email message content
- Parse out the Sender's email address and Name (if it was provided);
- Save a copy of the message to a MySQL database, for archival purposes
- Send a "Thank you" email to the sender of the original message
- Send a notification to the client that a new message has been received.

First we need to install [Lumen](http://lumen.laravel.com):

```bash
$ composer create-project laravel/lumen inbox --prefer-dist
```

This will install Lumen to the "inbox" folder in my projects directory. We are going to be using Facades and Eloquent in this project, and personally I prefer using the `phpdotenv` config files, so we need to uncomment those lines in `/bootstrap/app.php` to enable those features:

```php
// bootstrap/app.php
Dotenv::load(__DIR__.'/../');

// ...

$app->withFacades();

$app->withEloquent();
```

Now we need to pull in two additional packages via composer: `illuminate/mail` and `guzzlehttp/guzzle`:

```
$ composer require illuminate/mail
$ composer require guzzlehttp/guzzle
```

Lumen does not come with email functionality out of the box, so we are pulling that in here. Also, we need Guzzle to make use of the Mandrill API. Add a config file called `/config/services.php` like so:

```php
// config/services.php
return array(
    'mandrill' => [
        'secret' => env('MANDRILL_API_KEY'),
    ],
);
```

Find the `.env.example` file in your project's root folder and save it as "`.env`". This is where we will keep our environmental configuration values. Add a line for your Mandrill API key:

```
MANDRILL_API_KEY=XXXXXXXXXXXXXX
```

You should add 32 character random App key while you are here, as well as making sure that your DB credentials are accurate.

If you want to store copies of your messages in your database, you should create a migration and set up that database now:

```php
class CreateMessagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('name');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
    }
}
```

Now we are ready to set up our routing. In the file `app/Http/routes.php`, add these route:

```php
// app/Http/routes.php
$app->post('/contact', [
    'uses' => 'App\Http\Controllers\ContactController@newMessage'
]);

$app->get('/', function () use ($app) {
    return response()->json(['ok'], 200);
});
```

The first route received the Mandrill Post data and sends it to the `newMessage` method on our soon to be created ContactController. The second route is just a convenient way to ping the service and make sure it is running.

If this were a larger application, I would next suggest thinking about abstracting our code into a library for handling Mandrill Post Data, and then injecting that library into our ContactController. However, this is such a small service that I don't think we need to really worry about that. True, if we find that we want to handle multiple endpoints with this code, we will gain a lot by abstracting this code into a library that can be used wherever we need it (in keeping with the DRY spirit.) However, we are only concerned with one endpoint for now, so I am going to keep all of the logic within the `newMessage` controller method.

Create a file called `App/Http/Controllers/ContactController.php` with a method called `newMessage`:

```php
// app/Http/Controllers/ContactController.php
/**
* Handle a Mandrill Inbound API message
*
* @param Request $request
* @return Response
*/
public function newMessage(Request $request)
{
    // Gather the POST data from Mandrill - if nothing is there, we can call it quits
    $mandrillEvents = $request->input('mandrill_events', null);
    if (!$mandrillEvents) {
        return response()->json(['ok'], 200);
    }

    // Decode the WebHook data and get the text content of the email
    $mail = json_decode($mandrillEvents);
    $body = $mail[0]->msg->text;

    // Extract the sender's email and the story from the body of the email
    $senderEmail = $this->parseSenderEmail($body);
    $senderName = $this->parseSenderName($body);

    //Write the story to the DB
    DB::table('messages')->insert([
        'email' => $senderEmail,
        'name' => $senderName,
        'message' => $body,
    ]);

    //Send a confirmation email to the submitter
    $this->acknowledge($senderName, $senderEmail);

    // Send a notification that a story was received
    return $this->notify($body, $senderName);
}
```

First we gather the `mandrill_events` Post data from the http request. Note that Lumen does not provide an "Input::" facade, we need to get our input directly from the `$request` object. Per the [Mandrill Inbound API](https://mandrill.zendesk.com/hc/en-us/articles/205583207-What-is-the-format-of-inbound-email-webhooks-), this is a json encoded array of data representing the email message. The `$mail` array represents the decoded message data.

This email is being sent to us via WordPress, so we have quite a bit of control over the format it is being sent to us in. We don't need to concern ourselves with the headers, or the sender's email address (in this case the sender is our WordPress installation.) All we need is the text from the body of the message, which we gather like so: `$body = $mail[0]->msg->text;`. Now we have the text content of the message and we can do whatever we need to with it.

In my case, I have set up the WordPress contact form to include the Sender's name and email address within the body of the message. To extract them, I created two private methods (`parseSenderEmail()` and `parseSenderName()`). The implementation of these methods will depend greatly on the format of the message - your specific implementations will be different from mine so I have not shown them here.

Next we write a copy of the message to the database using the `DB` facade, and then we send two emails: The first is the acknowledgement message sent to the person who contacted us in the first place, and the second is the notification sent to the client. Here are those two methods:

```php
// app/Http/Controllers/ContactController.php
/**
 * Send an acknowledgement email to the person who contacted us
 *
 * @param $senderName
 * @param $senderEmail
 */
private function acknowledge($senderName, $senderEmail)
{
    if (filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
        Mail::send('emails.thankyou', [], function($message) use ($senderName, $senderEmail) {
            $message->from('client@clientdomain.com', 'Client Name');
            $message->subject('Thank you for contacting us');
            $message->to($senderEmail, $senderName);
        });
    }
}

 /**
 * Send a notification to 'contact@example.com`
 * @param $body
 * @return
 */
private function notify($body, $senderName)
{
    Mail::send('emails.notify', ['body' => nl2br($body)], function($message) use ($senderName) {
        $message->from('client@clientdomain.com', 'Client Name');
        $message->subject('A New Contact Request from  ' . $senderName);
        $message->to('client@clientdomain.com', 'Client Name');
    });

    return response()->json(['ok'], 200);
}
```

In the `acknowledge()` method we are first making sure that the email address we were provided with is valid. If it is, we send an email address to that address with some boilerplate text, which comes from the `/resources/views/emails/thankyou.blade.php` file.

In the second method, we are essentially forwarding the content of the message to the client directly. We pass the `$body` content to a blade file called `/resources/views/emails/notify.blade.php`, which looks like this:

```html
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        {!! $body !!}
    </body>
</html>
```

Note the use of `nl2br()` to keep the basic formatting in place. We read the text version of the message, which uses newline characters that will be lost when we show the text in html. Using `nl2br()` to convert the newlines to "&lt;br /&gt;" tags maintains the basic message format that we are expecting.

That is really all there is to it. Deploy the code to the client's server and you should be good to go.
