<?php

namespace Rir\UserAccountNotify;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Notifications\Notification;

class UserAccountChannel
{
    protected $client;

    protected $notify_url;
    protected $token_url;
    protected $client_id;
    protected $client_secret;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;

        $this->notify_url = config('user_account.notify_url');
        $this->token_url = config('user_account.token_url');
        $this->client_id = config('user_account.client_id');
        $this->client_secret = config('user_account.client_secret');
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toUserAccount($notifiable);

        $access_token = $this->getFreshToken();

        retry(3, function () use ($message, &$access_token) {
            try {
                return $this->client->request(
                    'POST', $this->notify_url, [
                        'json'    => $message,
                        'headers' => [
                            'Content-Type'  => 'application/json',
                            'Authorization' => "Bearer " . $access_token
                        ]
                    ]
                );
            } catch (ClientException $e) {
                if ($e->getResponse()->getStatusCode() === 401) {
                    $access_token = $this->getFreshToken();
                };
                throw new \Exception();
            }
        }, 500);
    }

    /**
     * Get fresh access token.
     *
     * @return string
     */
    private function getFreshToken(): string
    {
        $response = $this->client->request(
            'POST', $this->token_url, [
            'form_params' => [
                'client_id'     => $this->client_id,
                'client_secret' => $this->client_secret,
                'grant_type'    => 'client_credentials'
            ]
        ])
            ->getBody()
            ->getContents();

        $access_token = json_decode($response)->access_token;

        return $access_token;
    }
}