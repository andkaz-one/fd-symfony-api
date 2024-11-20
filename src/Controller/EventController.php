<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Event;
use App\Service\EventsService;
use App\Service\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


class EventController extends AbstractController
{
    #[Route('/event', methods: ['POST'])]
    public function index(
        Request       $request,
        Validator     $validator,
        EventsService $eventsService
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        $event = new Event();
        $event->setDeviceId($data['deviceId']);
        $event->setEventDate(new \DateTime($data['eventDate']));
        $event->setEventType($data['eventType']);


        if ($event->getEventType() === 'deviceMalfunction') {
            $event->setReasonCode($data['reasonCode']);
            $event->setReasonText($data['reasonText']);
        } elseif ($event->getEventType() === 'temperatureExceeded') {
            $event->setTemp($data['temp']);
            $event->setThreshold($data['threshold']);
        } elseif ($event->getEventType() === 'doorUnlocked') {
            $event->setUnlockDate(new \DateTime($data['unlockDate']));
        }


        $validator->validate($event);
        $eventsService->index($event);

        return new JsonResponse(['status' => 'ok']);
    }
}
