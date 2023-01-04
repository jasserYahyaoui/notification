<?php

namespace App\Resources\config\denormalizer;

use App\Entity\NotificationStat;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @todo unit test returned data
 */
class NotificationStatDenormalizer implements DenormalizerInterface, CacheableSupportsMethodInterface
{
    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return NotificationStat::class === $type;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return $data;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}