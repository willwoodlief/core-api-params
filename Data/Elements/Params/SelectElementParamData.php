<?php

namespace App\Data\ApiParams\Data\Elements\Params;




use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\Rules\ValidateAttributeRef;
use App\Data\ApiParams\Rules\ValidateElementArray;
use App\Data\ApiParams\Rules\ValidateNamespaceRef;
use App\Data\ApiParams\Rules\ValidatePhaseRef;
use App\Data\ApiParams\Rules\ValidateSetRef;
use App\Data\ApiParams\Rules\ValidateTypeRef;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Create one of more elements from the same type
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Select elements')]
class SelectElementParamData extends Data implements IResponse
{
    use FromRequest;

    public function __construct(

        #[OA\Property(title: 'Elements',description: 'The elements to select. ')]
        /** @var string[] $element_refs */
        public array|Optional $element_refs = [],


        #[Uuid]
        #[OA\Property(title: 'Type',description: 'The types elements are made from',type: HexbatchUuid::class)]
        public ?string $type_ref = null,

        #[Uuid]
        #[OA\Property(title: 'Set',description: 'The set which will have the elements',type: HexbatchUuid::class)]
        public ?string $set_ref = null,

        #[Uuid]
        #[OA\Property(title: 'Phase',description: 'The phase to restrict this selection',type: HexbatchUuid::class)]
        public ?string $phase_ref = null,


        #[Uuid]
        #[OA\Property(title: 'Namespace', description: 'The elements owned by this namespace', type: HexbatchUuid::class)]
        public ?string $namespace_ref = null,

        #[Uuid]
        #[OA\Property(title: 'Attribute',description: 'The selected elements have this attribute',type: HexbatchUuid::class)]
        public ?string $attribute_ref = null,

        #[OA\Property( title: 'Cursor')]
        public Optional|null|string $cursor = null

    ) {

    }


    public static function rules(ValidationContext $context): array
    {
        return [
            'element_refs' => new ValidateElementArray(),
            'type_ref' => new ValidateTypeRef(),
            'set_ref' => new ValidateSetRef(),
            'phase_ref' => new ValidatePhaseRef(),
            'namespace_ref' => new ValidateNamespaceRef(),
            'attribute_ref' => new ValidateAttributeRef(),
        ];
    }



}
