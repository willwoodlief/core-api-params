<?php

namespace App\Data\ApiParams\Data\Types\Params;




use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Show details about a type
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Type Params')]
class TypeParamData extends Data implements IResponse
{


    public function __construct(



        #[Uuid]
        #[OA\Property(title: 'Handle uuid',type: HexbatchUuid::class)]
        public Optional|string|null $handle_ref_uuid ,

        #[Uuid]
        #[OA\Property(title: 'Schedule uuid',type: HexbatchUuid::class)]
        public Optional|string|null $schedule_ref_uuid ,


        #[Max(60),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property(title: 'Name', description: 'Name of the type',type: HexbatchResourceName::class)]
        public null|string|Optional $type_name,


        #[OA\Property( title:"Is system")]
        public bool|Optional $is_system,

        #[OA\Property( title:"Is final")]
        public bool|Optional $is_final_type,

    ) {

    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }


    public static function fromRequest(Request $what): TypeParamData
    {
        $info = $what->request->all();
        if (empty($info)) {
            $info = $what->getPayload()->all();
        }
        $there =  TypeParamData::factory()
            ->withoutOptionalValues()
            ->from($info);

        TypeParamData::validate($there->toArray());

       return $there;

    }
}
