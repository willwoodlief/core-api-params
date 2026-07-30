<?php

namespace App\Data\ApiParams\Data\Elements\Params;




use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\Rules\ValidateAttributeRef;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Create one of more elements from the same type
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Write elements')]
class WriteElementParamData extends Data implements IResponse
{

    use FromRequest;
    public function __construct(

        #[OA\Property( title: 'Element selector of what will be written to. If set selected, will write to that set context, if attribute has that config', type: SelectElementParamData::class)]
        public SelectElementParamData $selector,

        #[Uuid]
        #[OA\Property(title: 'Attribute',description: 'The attribute to write to these elements',type: HexbatchUuid::class)]
        public string $attribute_ref ,

        #[OA\Property( title: 'Data',description: "object|array to save. Filtered by any attribute write rule",type: 'array',items:  new OA\Items())]
        public ?array $data,

    ) {

    }


    public static function rules(ValidationContext $context): array
    {
        return [
            'attribute_ref' => new ValidateAttributeRef()
        ];
    }


}
