<?php

namespace NotificationChannels\Hablame;

use Illuminate\Support\Arr;

class HablameMessage
{
    /** @var string */
    protected $toNumber;

    /** @var string */
    protected $sms;

    /** @var string|int */
    protected $flash = 0;

    /** @var string|null */
    protected $sc = '890202';


    protected $request_dlvr_rcpt = 0;

    /**
     * @param string $name
     *
     * @return static
     */
    public static function create($toNumber = '')
    {
        return new static($toNumber);
    }

    /**
     * @param string $name
     */
    public function __construct($toNumber = '')
    {
        $this->toNumber = $toNumber;
    }

    /**
     * Set the card name.
     *
     * @param $name
     *
     * @return $this
     */
    public function sms($sms)
    {
        $this->sms = $sms;

        return $this;
    }

    /**
     * Set the card name.
     *
     * @param $name
     *
     * @return $this
     */
    public function toNumber($toNumber)
    {
        $this->toNumber = $toNumber;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'toNumber' => $this->toNumber,
            'sms' => $this->sms,
            'flash' => $this->flash,
            'sc' => $this->sc,
            'request_dlvr_rcpt' => $this->request_dlvr_rcpt,
        ];
    }
}
