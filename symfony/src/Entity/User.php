<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class User
{
    private ?string $username = null;

    private ?string $email = null;

    private Collection $notificationCenters;

    public function __construct()
    {
        $this->notificationCenters = new ArrayCollection();
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
            $notificationCenter->setUser($this);
        }

        return $this;
    }

    public function removeNotificationCenter(NotificationCenter $notificationCenter): self
    {
        if ($this->notificationCenters->removeElement($notificationCenter)) {
            // set the owning side to null (unless already changed)
            if ($notificationCenter->getUser() === $this) {
                $notificationCenter->setUser(null);
            }
        }

        return $this;
    }
}
