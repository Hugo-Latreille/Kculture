<?php

namespace App\Serializer;

use App\Entity\Media;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Vich\UploaderBundle\Storage\StorageInterface;

// interface ContextAwareNormalizerInterface extends NormalizerInterface
// {
//   /**
//    * {@inheritdoc}
//    *
//    * @param array $context options that normalizers have access to
//    */
//   public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool;
// }

final class MediaNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
  use NormalizerAwareTrait;

  private const ALREADY_CALLED = 'MEDIA_NORMALIZER_ALREADY_CALLED';

  public function __construct(private StorageInterface $storage)
  {
  }

  public function normalize($object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
  {
    $context[self::ALREADY_CALLED] = true;

    $object->contentUrl = 'https://api.quasiquiz.net' . $this->storage->resolveUri($object, 'file');

    // dd($object->contentUrl);

    return $this->normalizer->normalize($object, $format, $context);
  }

  public function supportsNormalization($data, ?string $format = null, array $context = []): bool
  {
    if (isset($context[self::ALREADY_CALLED])) {
      return false;
    }

    return $data instanceof Media;
  }
}