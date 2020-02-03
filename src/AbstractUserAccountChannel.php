<?php

namespace Rir\UserAccountNotify;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

abstract class AbstractUserAccountChannel
{
    protected $client;
    protected $tokenizer;

    public function __construct()
    {
        $this->client = new Client();
        $this->tokenizer = new Tokenizer();
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  Notification $notification
     *
     * @return mixed
     */
    abstract public function send($notifiable, Notification $notification);
}
