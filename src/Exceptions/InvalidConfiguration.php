<?php

namespace NotificationChannels\Hablame\Exceptions;

class InvalidConfiguration extends \Exception
{
    public static function configurationNotSet()
    {
        return new static('In order to send notification via Hablame you need to add credentials in the `hablame` key of `config.services`.');
    }
}
