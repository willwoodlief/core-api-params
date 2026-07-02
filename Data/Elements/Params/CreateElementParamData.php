<?php

namespace App\Data\ApiParams\Data\Elements\Params;




use App\Data\ApiParams\Common\HexbatchPositiveInteger;
use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Create one of more elements from the same type
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Create element')]
class CreateElementParamData extends Data implements IResponse
{
    use FromRequest;

    public function __construct(

        #[Uuid]
        #[OA\Property(title: 'Type',description: 'The element is made from this type. Can be uuid or name',type: HexbatchUuid::class)]
        public ?string $type_ref = null,

        #[Uuid]
        #[OA\Property(title: 'Namespace',
            description: 'The new elements are put into this namespace. Can be uuid or name. If missing will be put into calling namespace',
            type: HexbatchUuid::class)]
        public ?string $namespace_ref = null,

        #[Uuid]
        #[OA\Property(title: 'Phase',
            description: 'The new elements are put into this phase. Can be uuid or name. If missing will be put into the default phase',
            type: HexbatchUuid::class)]
        public ?string $phase_ref = null,

        #[Min(1)]
        #[OA\Property(title: 'Number to create',description: 'If missing will be one.',type: HexbatchPositiveInteger::class)]
        public int $number_to_create

    ) {

    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }



}
