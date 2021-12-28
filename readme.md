<a href="https://www.twilio.com">
  <img src="https://static0.twilio.com/marketing/bundles/marketing/img/logos/wordmark-red.svg" alt="Twilio" width="250" />
</a>

# Server Notifications & Alerts with Twilio and Laravel

[![Build Status](https://github.com/TwilioDevEd/server-notifications-laravel/actions/workflows/laravel.yml/badge.svg)](https://github.com/TwilioDevEd/server-notifications-node/actions/workflows/laravel.yml)

Use Twilio to create SMS alerts so that you never miss a critical issue.

[Read the full tutorial here](https://www.twilio.com/docs/tutorials/walkthrough/server-notifications/php/laravel)!

## Local Development

1. Grab latest source

   ```bash
   git clone git@github.com:TwilioDevEd/server-notifications-laravel.git
   ```

1. Copy the sample configuration file and edit it to match your configuration.

   ```bash
   cp .env.example .env
   ```
   You can find your `TWILIO_ACCOUNT_SID` and `TWILIO_AUTH_TOKEN` under
   your [Twilio Account Settings](https://www.twilio.com/user/account/settings).
   You can buy Twilio phone numbers at
   [Twilio numbers](https://www.twilio.com/user/account/phone-numbers/search)
   `TWILIO_NUMBER` should be set to the phone number you purchased above.
   `TWILIO_RR_NUMBER` should be set to a Twilio number too.

1. Customize `config/administrators.json` with your name and phone number.

1. Install the dependencies with [Composer](https://getcomposer.org/).

   ```bash
   composer install
   ```

1. Generate an `APP_KEY`.

   ```bash
   php artisan key:generate
   ```

1. Start the server.

   ```bash
   php artisan serve
   ```

### How To Demo?

Visit the application's error route at
[http://localhost:8000/error](http://localhost:8000/error). You'll
soon get a message informing you of an error.

## Meta

* No warranty expressed or implied. Software is as is. Diggity.
* [MIT License](http://www.opensource.org/licenses/mit-license.html)
* Lovingly crafted by Twilio Developer Education.
