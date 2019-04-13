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
