# Server Notifications & Alerts with Twilio and Laravel

[![Build Status](https://travis-ci.org/TwilioDevEd/server-notifications-laravel.svg?branch=master)](https://travis-ci.org/TwilioDevEd/server-notifications-laravel)
![server status](http://howtodocs.s3.amazonaws.com/new-relic-monitor.png "Server notifications")

Use Twilio to create sms server alerts so that you never miss a critical server issue.

## Running the application

Clone this repository and cd into the directory then.

```
$ composer update
$ export TWILIO_ACCOUNT_SID=your account sid
$ export TWILIO_AUTH_TOKEN=your auth token
$ export TWILIO_NUMBER=+16515559999
$ php artisans serve
```

Then visit the application at http://localhost:8000/

This route will trigger an error and send a message to the numbers
configured under `config/administrators.json`.

## Dependencies

This application uses this Twilio helper library:
* [twilio-php](https://github.com/twilio/twilio-php)

### Run the tests

Run `phpunit` at the top level directory.
