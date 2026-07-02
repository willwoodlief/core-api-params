<?php

namespace App\Data\ApiParams\Data\Sets\Params;




use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Create a set from an element
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Create set')]
class CreateSetParamData extends Data implements IResponse
{
    use FromRequest;

    public function __construct(

        #[Uuid]
        #[OA\Property(title: 'Has events',description: 'A set can choose to turn off events fired when an element enters or leaves it. Cannot be changed later.')]
        public bool $has_events = true,

        #[Uuid]
        #[OA\Property(title: 'Parent',
            description: 'A set can optionally have a parent set.  Parents cannot be changed later. Children can be parents.',
            type: HexbatchUuid::class)]
        public ?string $parent_set_ref = null,



    ) {

    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }



}
