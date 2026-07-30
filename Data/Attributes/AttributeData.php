<?php

namespace App\Data\ApiParams\Data\Attributes;



use App\Data\ApiParams\Casts\FromArrayObjectOrString;
use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\Data\Locations\Location;
use App\Data\ApiParams\Data\Types\ElementTypeData;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;

use App\Enums\Attributes\TypeOfElementValuePolicy;
use App\Enums\Attributes\TypeOfServerAccess;
use App\Enums\Types\TypeOfApproval;
use Carbon\Carbon;
use Illuminate\Support\Collection;
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
    use FromRequest;

    /**
     * @param Optional|Lazy|null|Collection<int, AttributeData> $attribute_ancestors
    */
    public function __construct(


        #[Uuid]
        #[OA\Property(title: 'Uuid',type: HexbatchUuid::class)]
        public Optional|string|null $ref_uuid ,


        #[Max(60),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property(title: 'Name', description: 'Name of the attribute',type: HexbatchResourceName::class)]
        public null|string|Optional $attribute_name,


        #[OA\Property( title:"Is system")]
        public null|bool|Optional $is_system,

        #[OA\Property( title:"Is final")]
        public null|bool|Optional $is_final_attribute,

        #[OA\Property( title:"Is abstract")]
        public null|bool|Optional $is_abstract,

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

        #[Uuid]
        #[OA\Property(title: 'Type Uuid',type: HexbatchUuid::class)]
        public Optional|string|null $type_uuid ,

        #[OA\Property( title: 'Parent', type: AttributeData::class)]
        #[AutoWhenLoadedLazy]
        public null|AttributeData|Optional|Lazy $attribute_parent,


        #[OA\Property( title: 'Design attribute', type: AttributeData::class)]
        #[AutoWhenLoadedLazy]
        public null|AttributeData|Optional|Lazy $attribute_design,


        #[OA\Property( title: 'Ancestors', description: "Ancestors", type: 'array', items: new OA\Items(type: AttributeData::class))]
        #[AutoWhenLoadedLazy]
        public Collection|Optional|Lazy|null $attribute_ancestors = null,




        #[OA\Property( title: 'Type', type: ElementTypeData::class)]
        public null|ElementTypeData|Optional $type_owner = null,


        #[OA\Property( title: 'Shape or map', type: Location::class)]
        #[AutoWhenLoadedLazy]
        public null|Location|Optional|Lazy $attribute_location = null,

        #[OA\Property( title: "Blurb")]
        /** @uses \App\Models\Attribute::getBlurbAttribute() */
        public ?string $blurb = null,

        #[OA\Property( title: "Description")]
        /** @uses \App\Models\Attribute::getNotesAttribute() */
        public ?string $notes = null


    ) {

    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }



}
