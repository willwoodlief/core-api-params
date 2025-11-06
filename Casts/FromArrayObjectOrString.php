<?php

namespace App\Data\ApiParams\Casts;

use Illuminate\Database\Eloquent\Casts\ArrayObject;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class FromArrayObjectOrString implements Cast, Transformer
{
    /**
     * @throws \JsonException
     */
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): array|Uncastable
    {

        if ($value instanceof ArrayObject) {
            return $value->toArray();
        }

        if (is_array($value)) {
            return $value;
        }

        if (is_string($value) && json_validate($value) ) {
            return json_decode($value,associative: true,flags: JSON_THROW_ON_ERROR);
        }
        return Uncastable::create();
    }

    /**
     * @throws \JsonException
     */
    public function transform(DataProperty $property, mixed $value, TransformationContext $context): mixed
    {
        if ($value instanceof ArrayObject) {
            return $value->toArray();
        }

        if (is_array($value)) {
            return $value;
        }

        if (is_string($value) && json_validate($value) ) {
            return json_decode($value,associative: true,flags: JSON_THROW_ON_ERROR);
        }
        return Uncastable::create();
    }
}
