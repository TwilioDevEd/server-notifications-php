<?php

require __DIR__.'/vendor/autoload.php';

use App\Exceptions\TwilioExceptionHandler;

// Load environment variables from .env, or environment if available
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$DISPLAY_ERRORS = $_ENV['DISPLAY_ERRORS'];
ini_set('display_errors', $DISPLAY_ERRORS);

$accountSid =  $_ENV['TWILIO_ACCOUNT_SID'];
$authToken =  $_ENV['TWILIO_AUTH_TOKEN'];
$twilioNumber =  $_ENV['TWILIO_NUMBER'];

new TwilioExceptionHandler($accountSid, $authToken, $twilioNumber);

throw new Exception('Uh oh server error');
