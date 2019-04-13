<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    /**
     * Handle a Mandrill Inbound API message
     *
     * @param  Request $request
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
        DB::table('messages')->insert(
            ['email' => $senderEmail, 'name' => $senderName, 'message' => $body]
        );

        //Send a confirmation email to the submitter
        $this->acknowledge($senderName, $senderEmail);

        // Send a notification that a story was received
        return $this->notify($body, $senderName);
    }
}
