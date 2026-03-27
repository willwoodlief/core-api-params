<?php

namespace App\Data\ApiParams\Data\Types\Params;




use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Show details about a type
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Type Params')]
class TypeParentsParamData extends Data implements IResponse
{


    public function __construct(


        #[OA\Property( title: 'Parent uuids',  type: 'array', items: new OA\Items(type: HexbatchUuid::class))]
        /** @var string[] $parent_uuids */
        public array $parent_uuids = []

    ) {

    }


    public static function rules(ValidationContext $context): array
    {
        return [
            'parent_uuids.*' => ['required', 'uuid'],
        ];
    }


    public static function fromRequest(Request $what): TypeParentsParamData
    {
        $info = $what->request->all();
        if (empty($info)) {
            $info = $what->getPayload()->all();
        }
        $there =  TypeParentsParamData::factory()
            ->withoutOptionalValues()
            ->from($info);

        TypeParentsParamData::validate($there->toArray());

       return $there;

    }
}
