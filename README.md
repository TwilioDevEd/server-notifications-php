<a href="https://www.twilio.com">
  <img src="https://static0.twilio.com/marketing/bundles/marketing/img/logos/wordmark-red.svg" alt="Twilio" width="250" />
</a>

# Server Notifications & Alerts with Twilio and PHP

[![Build Status](https://travis-ci.org/TwilioDevEd/server-notifications-php.svg?branch=master)](https://travis-ci.org/TwilioDevEd/server-notifications-php)

Use Twilio to create SMS alerts so that you never miss a critical issue.

[Read the full tutorial here](https://www.twilio.com/docs/tutorials/walkthrough/server-notifications/php/php)!

## Local Development

1. Grab latest source.

   ```bash
   git clone git@github.com:TwilioDevEd/server-notifications-php.git
   ```

1. Copy the sample configuration file and edit it to match your configuration.

   ```bash
   cp .env.example .env
   ```

   You can find your `TWILIO_ACCOUNT_SID` and `TWILIO_AUTH_TOKEN` under
   your [Twilio Account Settings](https://www.twilio.com/console).
   You can buy Twilio phone numbers at
   [Twilio numbers](https://www.twilio.com/console/phone-numbers)
   `TWILIO_NUMBER` should be set to the phone number you purchased above.

1. Load your environment variables.

    ```bash
    source .env
    ```

1. Customize `config/administrators.json` with your name and phone number.

1. Install the dependencies with [Composer](https://getcomposer.org/).

   ```bash
   composer install
   ```

1. Start the server.

   ```bash
   php -S localhost:8080
   ```

### How To Demo?

Visit the application root to trigger an error.
[http://localhost:8080](http://localhost:8080). You'll
soon get a message informing you o. an error.

### Run tests

```bash
make tests
```

On Windows:
```bash
.\bin\phpunit.bat
```

## Meta

* No warranty expressed or implied. Software is as is. Diggity.
* [MIT License](http://www.opensource.org/licenses/mit-license.html)
* Lovingly crafted by Twilio Developer Education.
