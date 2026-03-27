<?php

namespace App\Data\ApiParams\Data\Attributes;



use App\Data\ApiParams\Casts\FromArrayObjectOrString;
use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Locations\Location;
use App\Data\ApiParams\Data\Types\ElementTypeData;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;

use App\Enums\Attributes\TypeOfElementValuePolicy;
use App\Enums\Attributes\TypeOfServerAccess;
use App\Enums\Types\TypeOfApproval;
use Carbon\Carbon;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\AutoWhenLoadedLazy;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithCastAndTransformer;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Show details about an attribute
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Attribute')]
class AttributeData extends Data implements IResponse
{

/*
 attribute_name, is_system, is_final_attribute, is_abstract, access_policy, value_policy, attribute_approval, read_json_path,
validate_json_path, attribute_default_value,
created_at, updated_at. Parameters missing: attribute_parent, attribute_design, type_owner, attribute_location
 */

    public function __construct(


        #[Uuid]
        #[OA\Property(title: 'Uuid',type: HexbatchUuid::class)]
        public Optional|string|null $ref_uuid ,


        #[Max(60),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property(title: 'Name', description: 'Name of the attribute',type: HexbatchResourceName::class)]
        public null|string|Optional $attribute_name,


        #[OA\Property( title:"Is system")]
        public bool|Optional $is_system,

        #[OA\Property( title:"Is final")]
        public bool|Optional $is_final_attribute,

        #[OA\Property( title:"Is abstract")]
        public bool|Optional $is_abstract,

        #[OA\Property(title: 'Access policy')]
        public Optional|null|TypeOfServerAccess $access_policy,

        #[OA\Property(title: 'Value policy')]
        public Optional|null|TypeOfElementValuePolicy $value_policy,

        #[OA\Property(title: 'Approval')]
        public Optional|null|TypeOfApproval $attribute_approval,

        #[OA\Property( title:"Read json path")]
        public string|Optional|null $read_json_path,

        #[OA\Property( title:"Validate json path")]
        public string|Optional|null $validate_json_path,


        #[OA\Property( title: "Default value", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromArrayObjectOrString::class)]
        public null|array|Optional $attribute_default_value,



        #[OA\Property( title: 'Created at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $created_at,

        #[OA\Property( title: 'Updated at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $updated_at,

        #[OA\Property( title: 'Parent', type: AttributeData::class)]
        #[AutoWhenLoadedLazy]
        public AttributeData|Optional|Lazy $attribute_parent,


        #[OA\Property( title: 'Design attribute', type: AttributeData::class)]
        #[AutoWhenLoadedLazy]
        public AttributeData|Optional|Lazy $attribute_design,


        #[OA\Property( title: 'Type', type: ElementTypeData::class)]
        #[AutoWhenLoadedLazy]
        public ElementTypeData|Optional|Lazy $type_owner,


        #[OA\Property( title: 'Shape or map', type: Location::class)]
        #[AutoWhenLoadedLazy]
        public Location|Optional|Lazy $attribute_location,



    ) {
    }

    #[OA\Property( title:"Full name")]
    /** @uses \App\Models\Attribute::getFullNameAttribute() */
    public Optional|string|null $full_name;

    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }


    public static function fromRequest(Request $what): AttributeData
    {
        $info = $what->request->all();
        if (empty($info)) {
            $info = $what->getPayload()->all();
        }
        $there =  AttributeData::factory()
            ->withoutOptionalValues()
            ->from($info);

        AttributeData::validate($there->toArray());

       return $there;

    }
}
