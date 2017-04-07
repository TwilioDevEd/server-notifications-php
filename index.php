<?php

require __DIR__.'/vendor/autoload.php';

use App\Exceptions\TwilioExceptionHandler;

new TwilioExceptionHandler();

throw new Exception('Uh oh server error');
