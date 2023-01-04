<?php

namespace App\Component\Notification\Application\DTO\Response;

use App\Entity\NotificationCollection;
use function Symfony\Component\Console\Input\getDescription;

/**
 * @todo create unit test with Prophecy to test responses
 */
class GetNotificationListResponse implements ResponseInterface
{
    private NotificationCollection $notificationCollection;

    public function __construct(NotificationCollection $notificationCollection)
    {
        $this->notificationCollection = $notificationCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(array $context = []): array
    {
        $notifications = [];
        if (0 === $this->notificationCollection->count()) {
            return ['message' => 'You dont have any notification yet !'];
        }
        foreach ($this->notificationCollection->all() as $notification) {
            $notifications[] = [
                'name' => $notification->getName(),
                'createdAt' => $notification->getCreatedAt(),
                'isRead' => $notification->getIsRead(),
                'validFrom' => $notification->getValidFrom()?->format(\DateTime::ATOM),
                'validTo'=> $notification->getValidTo()?->format(\DateTime::ATOM),
                'content'=>[
                    'title'=>$notification->getContent()?->getTitle(),
                    'album'=>[
                        'name'=>$notification->getContent() ?->getAlbum()?->getName(),
                        'artist' => [
                                'name' => $notification->getContent()?->getAlbum()?->getArtist()?->getName()
                            ],
                        'track' => [
                                'title' => $notification->getContent()?->getAlbum()?->getTrack()?->getTitle(),
                                'image' => $notification->getContent()?->getAlbum()?->getTrack()?->getImage(),
                            ]
                        ],
                    'playlist' => [
                        'name' => $notification->getContent()?->getPlaylist()?->getTitle(),
                            ],
                    ],
            ];
        }

        return ['notifications' => $notifications];
    }
}