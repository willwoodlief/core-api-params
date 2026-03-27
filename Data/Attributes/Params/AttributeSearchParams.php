<?php

namespace App\Data\ApiParams\Data\Attributes\Params;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use App\Enums\Attributes\TypeOfElementValuePolicy;
use App\Enums\Attributes\TypeOfServerAccess;
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
 * Show details about an attribute
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Attribute search params')]
class AttributeSearchParams extends Data implements IResponse
{



    public function __construct(


        #[Uuid]
        #[OA\Property(title: 'Parent uuid',type: HexbatchUuid::class)]
        public Optional|string|null $parent_uuid ,

        #[Uuid]
        #[OA\Property(title: 'Design uuid',type: HexbatchUuid::class)]
        public Optional|string|null $design_uuid ,

        #[Uuid]
        #[OA\Property(title: 'Location uuid',type: HexbatchUuid::class)]
        public Optional|string|null $location_uuid ,

        #[Uuid]
        #[OA\Property(title: 'Type uuid',type: HexbatchUuid::class)]
        public Optional|string|null $type_uuid ,

        #[Uuid]
        #[OA\Property(title: 'Namespace uuid',type: HexbatchUuid::class)]
        public Optional|string|null $namespace_uuid ,



        #[Max(60),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property(title: 'Name', description: 'Name of the attribute',type: HexbatchResourceName::class)]
        public null|string|Optional $attribute_name,


        #[OA\Property( title:"Is system",default: false)]
        public null|bool|Optional $is_system,


        #[OA\Property( title: 'Cursor')]
        public Optional|null|string $cursor = null
    ) {
    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }


    public static function fromRequest(Request $what): AttributeSearchParams
    {
        $info = $what->request->all();
        if (empty($info)) {
            $info = $what->getPayload()->all();
        }
        $there =  AttributeSearchParams::factory()
            ->withoutOptionalValues()
            ->from($info);

        AttributeSearchParams::validate($there->toArray());

       return $there;

    }
}
