<?php

namespace App\Tests\Exceptions;

use App\Exceptions\TwilioExceptionHandler;
use \Exception;



class TwilioExceptionHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Ensure the current exception handler is TwilioExceptionHandler.
     */
    public function testConstructor()
    {
        new TwilioExceptionHandler();
        $handler = set_exception_handler('var_dump');
        restore_exception_handler();

        $this->assertInstanceOf(
            'App\Exceptions\TwilioExceptionHandler',
            $handler[0]
        );
    }

    /**
     * Ensure TwilioExceptionHandler::report() send an sms message to each
     * administrator in the json file.
     */
    public function testReport()
    {
        $testException = new Exception("Test Error.");

        $handlerMock = $this->getMockBuilder(TwilioExceptionHandler::Class)
            ->setMethods(['sendSms'])
            ->getMock();

        $handlerMock
            ->expects($this->exactly(2))
            ->method('sendSms')
            ->withConsecutive(
                [
                  $this->equalTo('+1555555555'),
                  $this->equalTo(
                      '[This is a test] It appears the server' .
                      ' is having issues. Exception: Test Error.' .
                      ' Go to http://newrelic.com for more details.'
                  )
                ],
                [
                  $this->equalTo('+1555555555'),
                  $this->equalTo(
                      '[This is a test] It appears the server' .
                      ' is having issues. Exception: Test Error.' .
                      ' Go to http://newrelic.com for more details.'
                  )
                ]
            );

        $handlerMock->report($testException);
    }
}

require_once('./src/Exceptions/TwilioExceptionHandler.php');
