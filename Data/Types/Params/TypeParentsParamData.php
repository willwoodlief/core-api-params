<?php

namespace App\Data\ApiParams\Data\Types\Params;




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
 * Show details about a type
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Parent for type params')]
class TypeParentsParamData extends Data implements IResponse
{
    use FromRequest;

    public function __construct(
        #[Uuid]
        #[OA\Property(title: 'Parent uuid',type: HexbatchUuid::class)]
        public string|null $parent_ref_uuid

    ) {

    }


    public static function rules(ValidationContext $context): array
    {
        return [];
    }



}
