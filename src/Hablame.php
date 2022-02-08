<?php

namespace NotificationChannels\Hablame;

class Hablame
{
    /** @var HttpClient HTTP Client */
    protected $account;

    /** @var null|string Telegram Bot API Token. */
    protected $apikey;

    /** @var string Telegram Bot API Base URI */
    protected $token;

    public function __construct(string $account = null, string $apikey = null, string $token = null)
    {
        $this->account = $account;
        $this->apikey = $apikey;
        $this->token =$token;
    }
}
