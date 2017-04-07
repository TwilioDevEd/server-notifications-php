<?php

namespace App\Exceptions;

use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
use Exception;

class TwilioExceptionHandler extends Exception
{
    public function __construct()
    {
        @set_exception_handler(array($this, 'report'));
    }

    /**
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, Twilio, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        http_response_code(500);
        $this->notifyThroughSms($e);
        echo $e;
    }

    private function notifyThroughSms($e)
    {
        echo $e;
        foreach ($this->notificationRecipients() as $recipient) {
            $this->sendSms(
                $recipient->phone_number,
                '[This is a test] It appears the server' .
                ' is having issues. Exception: ' . $e->getMessage() .
                ' Go to http://newrelic.com for more details.'
            );
        }
    }

    private function notificationRecipients()
    {
        $adminsFile = './config/administrators.json';
        try {
            $adminsFileContents = file_get_contents($adminsFile);

            return json_decode($adminsFileContents);
        } catch (FileNotFoundException $e) {
            echo $e;
            return [];
        }
    }

    protected function sendSms($to, $message)
    {
        $accountSid = getenv('TWILIO_ACCOUNT_SID');
        $authToken = getenv('TWILIO_AUTH_TOKEN');
        $twilioNumber = getenv('TWILIO_NUMBER');

        $client = new Client($accountSid, $authToken);

        try {
            $client->messages->create(
                $to,
                [
                    "body" => $message,
                    "from" => $twilioNumber
                    //   On US phone numbers, you could send an image as well!
                    //  'mediaUrl' => $imageUrl
                ]
            );
            echo 'Message sent to ' + $twilioNumber;
        } catch (TwilioException $e) {
            echo  $e;
        }
    }
}
