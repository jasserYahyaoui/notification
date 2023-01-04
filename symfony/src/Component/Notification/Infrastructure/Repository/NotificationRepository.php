<?php

namespace App\Component\Notification\Infrastructure\Repository;

use App\Entity\CheckNotification;
use App\Entity\NotificationCollection;
use App\Entity\NotificationStat;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;

/**
 * Class NotificationRepository
 * @package App\Component\Notification\Infrastructure\Repository
 */
class NotificationRepository /*implements NotificationRepositoryInterface*/
{
    use HandleResponse;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * NotificationRepository constructor.
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $serializer
     */
    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    public function browseNotificationByUserId(string $userId, ?string $isRead = null): NotificationCollection
    {
        $conn = $this->entityManager->getConnection();
        $sql = sprintf('
                  SELECT u.username, 
                  n.name, n.is_read, n.valid_from, n.valid_to, n.created_at,
                  nt.type as notification_type,
                  c.title as content_title,
                  a.name as album_name,
                  ar.name as artist_name,
                  tr.title as track_name,tr.image as track_image,
                  pl.title as playlist_name
                  
                  FROM `notification_center` nc
                  LEFT JOIN user u ON u.id = nc.user_id
                  LEFT JOIN notification n ON n.id = nc.notification_id
                  LEFT JOIN notification_type nt ON nt.id = n.notification_type_id
                  LEFT JOIN content c ON c.id = n.content_id
                  LEFT JOIN album a ON a.id = c.album_id
                  LEFT JOIN artist ar ON ar.id = a.artist_id
                  LEFT JOIN track tr ON tr.id = a.track_id
                  LEFT JOIN playlist pl ON pl.id = c.playlist_id
                  WHERE u.id = %s
                  ORDER BY n.created_at DESC
                  ', $userId);

        $isRead === null ?: $sql .= sprintf('AND n.is_read = %s ', $isRead);

        $query = $conn->prepare($sql);
        $response = $query->executeQuery()->fetchAll();

        return $this->handleResponse($response, NotificationCollection::class, $context = []);
    }

    public function getStatNotificationByUserId(string $userId): NotificationStat
    {
        $conn = $this->entityManager->getConnection();
        $sqlReaded = sprintf('
                  SELECT
                  COUNT(n.is_read) as countRead
                  FROM `notification_center` nc
                  LEFT JOIN user u ON u.id = nc.user_id
                  LEFT JOIN notification n ON n.id = nc.notification_id
                  WHERE u.id = %s
                  AND n.is_read = 1
                  GROUP BY n.is_read
                  ', $userId);
        $sqlUnReaded = sprintf('
                  SELECT
                  COUNT(n.is_read) as countUnRead
                  FROM `notification_center` nc
                  LEFT JOIN user u ON u.id = nc.user_id
                  LEFT JOIN notification n ON n.id = nc.notification_id
                  WHERE u.id = %s
                  AND n.is_read = 0
                  GROUP BY n.is_read
                  ', $userId);


        $query = $conn->prepare($sqlReaded);
        $responseRead = $query->executeQuery()->fetchAll();

        $query = $conn->prepare($sqlUnReaded);
        $responseUnRead = $query->executeQuery()->fetchAll();
        $response = [
            'countRead' => $responseRead[0]['countRead'] ?? 0,
            'countUnread' => $responseUnRead[0]['countUnRead'] ?? 0
        ];
        $response['allNotifications'] = $response['countRead'] + $response['countUnread'];

        return $this->handleResponse($response, NotificationStat::class, $context = []);
    }

    public function checkNotification(string $notificationId): CheckNotification
    {
        $conn = $this->entityManager->getConnection();
        $sql = sprintf('
                  SELECT
                  n.is_read
                  FROM `notification` n
                  WHERE n.id = %s
                  ', $notificationId);

        $query = $conn->prepare($sql);
        $response = $query->executeQuery()->fetchAll();

        return $this->handleResponse($response, CheckNotification::class, $context = []);
    }

    public function readNotification(string $notificationId): void
    {
        $conn = $this->entityManager->getConnection();
        $sql = sprintf('
                  UPDATE notification
                  SET is_read = true
                  WHERE id = %s;
                  ', $notificationId);

        $query = $conn->prepare($sql);
        $query->executeQuery();
    }
}