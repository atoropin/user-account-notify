<?php

namespace Rir\UserAccountNotify;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\JsonResponse;

class Tokenizer
{
    private $accessToken;

    protected $tokenUrl;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->tokenUrl = config('user_account.token_url');
        $this->clientId = config('user_account.client_id');
        $this->clientSecret = config('user_account.client_secret');
    }

    public function getToken()
    {
        if ($this->accessToken === null)
        {
            $this->accessToken = $this->renewAccessToken($this->clientId, $this->clientSecret, $this->tokenUrl);
        }

        return $this->accessToken;
    }

    /**
     * Refresh access token.
     *
     * @param $clientId
     * @param $clientSecret
     * @param $tokenUrl
     * @return string
     */
    protected function renewAccessToken($clientId, $clientSecret, $tokenUrl): string
    {
        $client = new Client();

        try {
            $response = $client->request(
                'POST', $tokenUrl, [
                'form_params' => [
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
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
