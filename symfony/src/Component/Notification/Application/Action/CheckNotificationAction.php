<?php

namespace App\Component\Notification\Application\Action;

use App\Component\Notification\Application\DTO\Request\RequestInterface;
use App\Component\Notification\Application\DTO\Response\CheckNotificationResponse;
use App\Component\Notification\Application\DTO\Response\GetNotificationListResponse;
use App\Component\Notification\Application\DTO\Response\GetStatNotificationResponse;
use App\Component\Notification\Application\DTO\Response\ResponseInterface;
use App\Component\Notification\Domain\Manager\NotificationManager;

/**
 * Class GetNotificationListAction
 * @package App\Component\Notification\Application\Action
 */
class CheckNotificationAction implements ActionInterface
{
    private NotificationManager $notificationManager;

    public function __construct(NotificationManager $notificationManager)
    {
        $this->notificationManager = $notificationManager;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function execute(RequestInterface $request): ResponseInterface
    {
        return new CheckNotificationResponse(
            $this->notificationManager->checkNotification(
                $request->getNotificationId()
            )
        );
    }
}