<?php

namespace App\Data\ApiParams\Data\Attributes\Params;



use App\Data\ApiParams\Casts\FromArrayObjectOrString;
use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use App\Enums\Attributes\TypeOfElementValuePolicy;
use App\Enums\Attributes\TypeOfServerAccess;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Attributes\WithCastAndTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Show details about an attribute
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Attribute Params')]
class AttributeParamData extends Data implements IResponse
{

    use FromRequest;

    public function __construct(


        #[Uuid]
        #[OA\Property(title: 'Parent uuid',type: HexbatchUuid::class)]
        public Optional|string|null $parent_ref_uuid ,

        #[OA\Property(title: 'Unset Parent',description: 'When editing an existing attribute and want to remove the parent',default: false)]
        public Optional|bool $unset_parent ,


        #[Uuid]
        #[OA\Property(title: 'Design uuid',type: HexbatchUuid::class)]
        public Optional|string|null $design_ref_uuid ,

        #[Uuid]
        #[OA\Property(title: 'Bounds uuid',type: HexbatchUuid::class)]
        public Optional|string|null $location_uuid ,


        #[Max(60),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property(title: 'Name', description: 'Name of the attribute',type: HexbatchResourceName::class)]
        public null|string|Optional $attribute_name,


        #[OA\Property( title:"Is final",default: false)]
        public null|bool|Optional $is_final_attribute,

        #[OA\Property( title:"Is abstract",default: false)]
        public null|bool|Optional $is_abstract,

        #[OA\Property( title:"Is element access",default: false)]
        public null|bool|Optional $is_element_access,

        #[OA\Property(title: 'Access policy',default: TypeOfServerAccess::IS_PRIVATE->value)]
        public Optional|null|TypeOfServerAccess $access_policy,

        #[OA\Property(title: 'Value policy',default: TypeOfElementValuePolicy::STATIC->value)]
        public Optional|null|TypeOfElementValuePolicy $value_policy,


        #[OA\Property( title:"Read json path")]
        public string|Optional|null $read_json_path,

        #[OA\Property( title:"Validate json path")]
        public string|Optional|null $validate_json_path,


        #[OA\Property( title: "Default value", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromArrayObjectOrString::class)]
        public null|array|Optional $attribute_default_value,



    ) {
    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }



}
