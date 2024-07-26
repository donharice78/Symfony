<?php

namespace App\Form\DataTransformer;

use App\Enum\CollectionEnum;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CollectionEnumTransformer implements DataTransformerInterface
{
    public function transform($value): ?string
    {
        // Transform CollectionEnum to string (value for the form)
        return $value ? $value->value : null;
    }

    public function reverseTransform($value): ?CollectionEnum
    {
        // Transform string (submitted by the form) to CollectionEnum
        if (!$value) {
            return null;
        }

        try {
            return CollectionEnum::from($value);
        } catch (\ValueError $e) {
            throw new TransformationFailedException(sprintf('Invalid value "%s" for CollectionEnum.', $value), 0, $e);
        }
    }
}