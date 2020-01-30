<?php

namespace Rir\UserAccountNotify;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\JsonResponse;

abstract class AbstractUserAccountChannel
{
    protected $client;

    protected $notify_url;
    protected $email_url;
    protected $token_url;
    protected $client_id;
    protected $client_secret;

    public function __construct()
    {
        $this->client = new Client();

        $this->notify_url = config('user_account.notify_url');
        $this->email_url = config('user_account.email_url');
        $this->token_url = config('user_account.token_url');
        $this->client_id = config('user_account.client_id');
        $this->client_secret = config('user_account.client_secret');
    }

    /**
     * Get fresh access token.
     *
     * @return string
     */
    protected function getFreshToken(): string
    {
        try {
            $response = $this->client->request(
                'POST', $this->token_url, [
                'form_params' => [
                    'client_id' => $this->client_id,
                    'client_secret' => $this->client_secret,
                    'grant_type' => 'client_credentials'
                ]
            ])
                ->getBody()
                ->getContents();
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $exception = (string)$e->getResponse()->getBody();
                $exception = json_decode($exception);
                return new JsonResponse($exception, $e->getCode());
            } else {
                return new JsonResponse($e->getMessage(), 503);
            }
        }

        return json_decode($response)->access_token;
    }
}
