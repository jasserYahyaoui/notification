<?php

namespace App\Resources\config\denormalizer;

use App\Entity\CheckNotification;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @todo unit test returned data
 */
class CheckNotificationDenormalizer implements DenormalizerInterface, CacheableSupportsMethodInterface
{
    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return CheckNotification::class === $type;
    }

    public function denormalize($data, $class, $format = null, array $context = []): mixed
    {
        return $data[0] ?? null;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}