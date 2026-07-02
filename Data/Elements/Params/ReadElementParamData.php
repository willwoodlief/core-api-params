<?php

namespace App\Data\ApiParams\Data\Elements\Params;




use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\Rules\ValidateAttributeArray;
use App\Data\ApiParams\Rules\ValidateTypeArray;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Create one of more elements from the same type
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Read elements')]
class ReadElementParamData extends Data implements IResponse
{

    use FromRequest;
    public function __construct(

        #[OA\Property( title: 'Element selector', type: SelectElementParamData::class)]
        public SelectElementParamData $selector,

        #[OA\Property(title: 'Attributes',description: 'Optionally only read these attributes ')]
        /** @var string[] $read_attributes */
        public array $read_attributes = [],

        #[OA\Property(title: 'Types',description: 'Optionally only read these types ')]
        /** @var string[] $read_types */
        public array $read_types = []

    ) {

    }


    public static function rules(ValidationContext $context): array
    {
        return [
            'read_attributes' => new ValidateAttributeArray(),
            'read_types' => new ValidateTypeArray(),

        ];
    }


}
