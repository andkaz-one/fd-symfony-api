<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[Assert\NotBlank]
    private string $deviceId;

    #[Assert\NotBlank]
    private \DateTimeInterface $eventDate;

    private ?int $reasonCode = null;

    private ?string $reasonText = null;

    private ?float $temp = null;

    private ?float $threshold = null;

    private ?\DateTimeInterface $unlockDate = null;

    private string $eventType;


    // Getters
    public function getEventDate(): \DateTimeInterface
    {
        return $this->eventDate;
    }

    public function getDeviceId(): string
    {
        return $this->deviceId;
    }

    public function getEventType(): string
    {
        return $this->eventType;
    }

    public function getTemperature(): ?float
    {
        return $this->temp;
    }

    public function getReasonCode(): ?int
    {
        return $this->reasonCode;
    }

    public function getReasonText(): ?string
    {
        return $this->reasonText;
    }

    public function getUnlockDate(): ?\DateTimeInterface
    {
        return $this->unlockDate;
    }


    // Setters
    public function setDeviceId(string $deviceId): void
    {
        $this->deviceId = $deviceId;
    }

    public function setEventDate(\DateTimeInterface $eventDate): void
    {
        $this->eventDate = $eventDate;
    }

    public function setTemp(?float $temp): void
    {
        $this->temp = $temp;
    }

    public function setEventType(string $eventType): void
    {
        $this->eventType = $eventType;
    }

    public function setReasonCode(?int $reasonCode): void
    {
        $this->reasonCode = $reasonCode;
    }

    public function setReasonText(?string $reasonText): void
    {
        $this->reasonText = $reasonText;
    }

    public function setThreshold(?float $threshold): void
    {
        $this->threshold = $threshold;
    }

    public function setUnlockDate(?\DateTimeInterface $unlockDate): void
    {
        $this->unlockDate = $unlockDate;
    }


}
