<?php

namespace App\Service;

use App\Entity\Event;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class Validator
{
    public function __construct(private readonly ValidatorInterface $validator) {}

    public function validate(Event $event): void
    {
        $errors = $this->validator->validate($event);

        if (count($errors) > 0) {
            throw new \InvalidArgumentException((string) $errors);
        }


        if ($event->getEventType() === 'deviceMalfunction' && !$event->getReasonCode()) {
            throw new \InvalidArgumentException('Reason code is required for deviceMalfunction');
        }

        if ($event->getEventType() === 'temperatureExceeded' && !$event->getTemperature()) {
            throw new \InvalidArgumentException('Temperature is required for temperatureExceeded');
        }
    }
}
