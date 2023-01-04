<?php

namespace App\Entity;

class NotificationCollection
{
    /**
     * @var Notification[]
     */
    protected $notifications;

    /**
     * NotificationCollection constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->setNotifications($items);
    }

    /**
     * @param array $notifications
     * @return NotificationCollection
     */
    public function setNotifications(array $notifications = []): self
    {
        $this->notifications = [];

        foreach ($notifications as $notification) {
            $this->add($notification);
        }

        return $this;
    }

    /**
     * @param Notification $notification
     * @return NotificationCollection
     */
    public function add(Notification $notification): self
    {
        $this->notifications[$notification->getName()] = $notification;

        return $this;
    }

    /**
     * @param string $code
     * @return NotificationCollection
     */
    public function remove(string $code): self
    {
        if ($this->has($code)) {
            unset($this->notifications[$code]);
        }

        return $this;
    }

    /**
     * @param string $code
     *
     * @return mixed|Notification|null
     */
    public function get(string $code)
    {
        return $this->notifications[$code] ?? null;
    }

    /**
     * @param string $code
     *
     * @return bool
     */
    public function has(string $code): bool
    {
        return isset($this->notifications[$code]);
    }

    /**
     * @return Notification[]
     */
    public function all(): array
    {
        return $this->notifications ?? [];
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return \count($this->notifications ?? []);
    }

    /**
     * @return Notification|null
     */
    public function first()
    {
        return reset($this->notifications ?? []) ?: null;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->notifications ?? []);
    }
}