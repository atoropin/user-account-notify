<?php

namespace Rir\UserAccountNotify;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Notifications\Notification;

class UserAccountMailChannel extends AbstractUserAccountChannel
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  Notification $notification
     *
     * @return mixed
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toUserMail($notifiable);

        $access_token = $this->getFreshToken();

        try {
        return $this->client->request(
            'POST', $this->email_url . 'send', [
                'json' => $message,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer " . $access_token
                ]
            ]
        );
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $exception = (string)$e->getResponse()->getBody();
                $exception = json_decode($exception);
                return new JsonResponse($exception, $e->getCode());
            } else {
                return new JsonResponse($e->getMessage(), 503);
            }
        }
    }
}
