<?php

namespace App\Service;

use App\Entity\Event;

class EventsService
{

    public function __construct()
    {

    }

    public function index(Event $event): void
    {
        switch ($event->getEventType()) {
            case 'deviceMalfunction':
                $this->sendToLog($event);
                $this->sendEmail($event);
                break;

            case 'temperatureExceeded':
                $this->sendToLog($event);
                $this->sendRequest($event);
                break;

            case 'doorUnlocked':
                $this->sendToLog($event);
                $this->sendSms($event);
                break;

            default:
                throw new \InvalidArgumentException('Unsupported event type');
        }
    }



    private function sendToLog(Event $event): void
    {
        print_r($event->getEventType());
    }

    private function sendEmail(Event $event): void
    {
        print_r($event->getDeviceId(), $event->getReasonText());
    }

    private function sendRequest(Event $event): void
    {
        print_r($event->getDeviceId(), $event->getTemperature());
    }

    private function sendSms(Event $event): void
    {
        print_r('doorUnlocked at: ', $event->getUnlockDate());
    }


}
