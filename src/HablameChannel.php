<?php

namespace NotificationChannels\Hablame;

use GuzzleHttp\Client;
use NotificationChannels\Hablame\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;
use NotificationChannels\Hablame\Exceptions\InvalidConfiguration;

class HablameChannel
{
    const API_ENDPOINT = 'https://api103.hablame.co/api/sms/v3/send/priority';

    protected $client;

    /** @param Client $client */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\Hablame\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $routing = collect($notifiable->routeNotificationFor('hablame'))) {
            return;
        }

        $account = config('services.hablame.account');
        $apikey = config('services.hablame.apikey');
        $token = config('services.hablame.token');

        if (is_null($account) || is_null($apikey) || is_null($token)) {
            throw InvalidConfiguration::configurationNotSet();
        }

        $hablameParameters = $notification->toHablame($notifiable)->toArray();

        $response = $this->client->request('POST',self::API_ENDPOINT, [
            'headers' => [
                'content-type' => 'application/json',
                'account' => $account,
                'apikey' => $apikey,
                'token' => $token,
            ],
            'body' => json_encode($hablameParameters),
        ]);

        if ($response->getStatusCode() !== 200) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }elseif(json_decode($response->getBody())->status !== '1x000'){
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }
    }
}
