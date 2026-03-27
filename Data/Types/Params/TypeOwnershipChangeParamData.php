<?php

namespace App\Data\ApiParams\Data\Types\Params;




use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use Illuminate\Http\Request;
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
#[OA\Schema(schema: 'Type Ownership change params')]
class TypeOwnershipChangeParamData extends Data implements IResponse
{


    public function __construct(


        #[Uuid]
        #[OA\Property(description: 'Namespace to change ownership to',type: HexbatchUuid::class)]
        public string $namespace_uuid

    ) {

    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }


    public static function fromRequest(Request $what): TypeOwnershipChangeParamData
    {
        $info = $what->request->all();
        if (empty($info)) {
            $info = $what->getPayload()->all();
        }
        $there =  TypeOwnershipChangeParamData::factory()
            ->withoutOptionalValues()
            ->from($info);

        TypeOwnershipChangeParamData::validate($there->toArray());

       return $there;

    }
}
