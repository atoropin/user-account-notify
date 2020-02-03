<?php

namespace Rir\UserAccountNotify;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Notifications\Notification;

class UserAccountChannel extends AbstractUserAccountChannel
{
    private $notifyUrl;

    public function __construct()
    {
        $this->notifyUrl = config('user_account.notify_url');
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
        $message = $notification->toUserAccount($notifiable);

        $accessToken = $this->tokenizer->getToken();

        try {
            return $this->client->request(
                'POST', $this->notifyUrl . 'send-notification', [
                    'json' => $message,
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => "Bearer " . $accessToken
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
