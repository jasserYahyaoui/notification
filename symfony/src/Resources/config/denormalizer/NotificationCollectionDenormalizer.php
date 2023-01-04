<?php

namespace App\Resources\config\denormalizer;

use App\Entity\NotificationCollection;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @todo unit test returned data
 */
class NotificationCollectionDenormalizer implements DenormalizerInterface, CacheableSupportsMethodInterface
{
    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return NotificationCollection::class === $type;
    }

    public function denormalize($data, $class, $format = null, array $context = []): array
    {
        dump('inisde CarsCollectionDenormalizer');
        $notificationCollection = [];
        foreach ($data as $notification) {
            $notificationCollection['notifications'][] = [
                'name' => $notification['name'],
                'isRead' => $notification['is_read'],
                'createdAt'=>(new \DateTime($notification['created_at']))->format(\DateTime::ATOM),
                'validFrom'=>(new \DateTime($notification['valid_from']))->format(\DateTime::ATOM),
                'validTo'=>(new \DateTime($notification['valid_to']))->format(\DateTime::ATOM),
                'content' => [
                    'title' => $notification['content_title'],
                    'album' => [
                        'name' => $notification['album_name'],
                        'artist' => [
                            'name' => $notification['artist_name'],
                        ],
                        'track' => [
                            'title' => $notification['track_name'],
                            'image' => $notification['track_image']
                        ]
                    ],
                    'playlist' => [
                        'title' => $notification['playlist_name'],
                    ],
                ]
            ];
        }

        return $notificationCollection;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}