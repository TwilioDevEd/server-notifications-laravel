<?php

namespace App\Exceptions;

use Log;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Services_Twilio;
use Services_Twilio_RestException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        $this->_notifyThroughSms($e);
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        return parent::render($request, $e);
    }

    private function _notifyThroughSms($e)
    {
        foreach ($this->_notificationRecipients() as $recipient) {
            $this->_sendSms(
                $recipient->phone_number,
                '[This is a test] It appears the server' .
                ' is having issues. Exception: ' . $e->getMessage() .
                ' Go to http://newrelic.com for more details.'
            );
        }
    }

    private function _notificationRecipients()
    {
        $adminsFile = base_path() .
                    DIRECTORY_SEPARATOR .
                    'config' . DIRECTORY_SEPARATOR .
                    'administrators.json';
        try {

            $adminsFileContents = \File::get($adminsFile);

            return json_decode($adminsFileContents);
        }
        catch(FileNotFoundException $e) {
            Log::error(
                'Could not find ' .
                $adminsFile .
                ' to notify admins through SMS'
            );
            return [];
        }
    }

    private function _sendSms($to, $message)
    {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_NUMBER');

        $twilioService = new Services_Twilio($accountSid, $authToken);

        try {
            $twilioService->account->messages->create(
                [
                    'From' => $twilioNumber,
                    'To' => $to,
                    'Body' => $message
                ]
            );
            Log::info('Message sent to' . $twilioNumber);
        }
        catch(Services_Twilio_RestException $e) {
            Log::error(
                'Could not send SMS notification' .
                ' Twilio replied with: ' . $e
            );
        }
    }
}
