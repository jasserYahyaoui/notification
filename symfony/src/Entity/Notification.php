<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Notification
{
    private ?\DateTimeInterface $validFrom = null;

    private ?\DateTimeInterface $validTo = null;

    private ?bool $isRead = null;

    private ?string $description = null;

    private Collection $notificationCenters;

    private ?NotificationType $notificationType = null;

    private ?Content $content = null;

    private ?string $name = null;

    private ?\DateTimeInterface $createdAt = null;

    public function __construct()
    {
        $this->notificationCenters = new ArrayCollection();
        $this->notificationTypes = new ArrayCollection();
    }

    public function getValidFrom(): ?\DateTimeInterface
    {
        return $this->validFrom;
    }

    public function setValidFrom(?\DateTimeInterface $validFrom): self
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    public function getValidTo(): ?\DateTimeInterface
    {
        return $this->validTo;
    }

    public function setValidTo(?\DateTimeInterface $validTo): self
    {
        $this->validTo = $validTo;

        return $this;
    }

    public function getIsRead(): ?bool
    {
        return $this->isRead;
    }

    public function setIsRead(bool $isRead): self
    {
        $this->isRead = $isRead;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, NotificationCenter>
     */
    public function getNotificationCenters(): Collection
    {
        return $this->notificationCenters;
    }

    public function addNotificationCenter(NotificationCenter $notificationCenter): self
    {
        if (!$this->notificationCenters->contains($notificationCenter)) {
            $this->notificationCenters->add($notificationCenter);
            $notificationCenter->setNotification($this);
        }

        return $this;
    }

    public function removeNotificationCenter(NotificationCenter $notificationCenter): self
    {
        if ($this->notificationCenters->removeElement($notificationCenter)) {
            // set the owning side to null (unless already changed)
            if ($notificationCenter->getNotification() === $this) {
                $notificationCenter->setNotification(null);
            }
        }

        return $this;
    }

    public function getNotificationType(): ?NotificationType
    {
        return $this->notificationType;
    }

    public function setNotificationType(?NotificationType $notificationType): self
    {
        $this->notificationType = $notificationType;

        return $this;
    }

    public function getContent(): ?Content
    {
        return $this->content;
    }

    public function setContent(?Content $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
