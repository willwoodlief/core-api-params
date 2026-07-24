<?php

namespace App\Data\ApiParams\Data\Types;



use App\Data\ApiParams\Casts\FromArrayObjectOrString;
use App\Data\ApiParams\Casts\FromBoxToArray;
use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Attributes\AttributeData;
use App\Data\ApiParams\Data\Elements\ElementData;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\Data\Namespaces\UserNamespaceData;
use App\Data\ApiParams\Data\Schedules\Schedule;
use App\Data\ApiParams\Data\Server\ServerInformation;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use App\Enums\Types\TypeOfLifecycle;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\AutoWhenLoadedLazy;
use Spatie\LaravelData\Attributes\Computed;
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
 * Show details about a type
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Type')]
class ElementTypeData extends Data implements IResponse
{

    use FromRequest;

    /**
     * @param Optional|Lazy|null|Collection<int, AttributeData> $type_exposed_attributes
     * @param Lazy|Optional|Collection<int, AttributeData> $type_attributes
     * @param Lazy|Optional|Collection<int, TypeParentData> $type_children
     * @param null|Lazy|Optional|Collection<int, TypeServerLevelData> $type_server_levels
     * @param Lazy|Optional|Collection<int, TypeParentData> $type_parents
    */
    public function __construct(


        #[Uuid]
        #[OA\Property(title: 'Type uuid',type: HexbatchUuid::class)]
        public Optional|string|null $ref_uuid = null,


        #[Max(60),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property(title: 'Name', description: 'Name of the type',type: HexbatchResourceName::class)]
        public null|string|Optional $type_name = null,


        #[OA\Property( title:"Is system")]
        public bool|Optional|null  $is_system = null ,

        #[OA\Property( title:"Is final")]
        public bool|Optional|null $is_final_type =  null,


        #[OA\Property(title: 'Lifecycle')]
        public Optional|null|TypeOfLifecycle $lifecycle = null,


        #[OA\Property( title: "Sum shapes", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromArrayObjectOrString::class)]
        public Optional|null|array $sum_shape_geom = null,

        #[OA\Property( title: "Sum maps", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromArrayObjectOrString::class)]
        public Optional|null|array $sum_map_geom = null,


        #[OA\Property( title: "Shape bounding box", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromBoxToArray::class)]
        public Optional|null|array $sum_shape_bounding_box = null,

        #[OA\Property( title: "Map bounding box", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromBoxToArray::class)]
        public Optional|null|array $sum_map_bounding_box = null,

        #[OA\Property( title: 'Created at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: [DATE_ATOM,'Y-m-d\TH:i:s\Z'])]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $created_at = null,

        #[OA\Property( title: 'Updated at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: [DATE_ATOM,'Y-m-d\TH:i:s\Z'])]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $updated_at = null,

        #[OA\Property( title: 'Server type is from', type: ServerInformation::class)]
        #[AutoWhenLoadedLazy]
        public ServerInformation|Optional|Lazy|null $type_server = null,


        #[OA\Property( title: "Namespace", type: UserNamespaceData::class)]
        #[AutoWhenLoadedLazy]
        public UserNamespaceData|Optional|Lazy|null $owner_namespace = null,


        #[OA\Property( title: "Handle", type: ElementData::class)]
        #[AutoWhenLoadedLazy]
        public ElementData|Optional|Lazy|null $type_handle  = null ,

        #[OA\Property( title: "Schedule", type: Schedule::class)]
        #[AutoWhenLoadedLazy]
        public Schedule|Optional|Lazy|null $type_schedule  = null ,
//

        #[OA\Property( title: 'Attributes', description: "The attributes in the type", type: 'array', items: new OA\Items(type: AttributeData::class))]
        #[AutoWhenLoadedLazy]
        /**
         * @var AttributeData[] $type_attributes
         */
        public Collection|Optional|Lazy|null $type_attributes = null,



        #[OA\Property( title: 'Parents', description: "The parents of the type", type: 'array', items: new OA\Items(type: TypeParentData::class))]
        #[AutoWhenLoadedLazy]
        public Collection|Optional|Lazy|null $type_parents = null,



        #[OA\Property( title: 'Children', description: "The immediate children of the type", type: 'array', items: new OA\Items(type: TypeParentData::class))]
        #[AutoWhenLoadedLazy]
        public Collection|Optional|Lazy|null $type_children = null ,


        #[OA\Property( title: 'Server permissions',  type: 'array', items: new OA\Items(type: TypeServerLevelData::class))]
        #[AutoWhenLoadedLazy]
        public Collection|Optional|Lazy|null $type_server_levels = null,


        #[OA\Property( title: 'Published attributes', description: "The attributes in the type", type: 'array', items: new OA\Items(type: AttributeData::class))]
        #[AutoWhenLoadedLazy]
            /**
             * @var AttributeData[] $type_exposed_attributes
             */
        public Collection|Optional|Lazy|null $type_exposed_attributes = null,




    ) {
        $this->inherited_attributes = [];
        $this->defined_attributes = [];
        if ($this->type_exposed_attributes instanceof Lazy) {
            foreach ($this->type_exposed_attributes?->toArray() as $attribute) {
                if (!isset($attribute['type_owner'])) {continue;}
                if ($attribute['type_owner']['ref_uuid'] === $this->ref_uuid) {
                    $this->defined_attributes[] = $attribute['ref_uuid'];
                } else {
                    $this->inherited_attributes[] = $attribute['ref_uuid'];
                }
            }
        }
    }

    #[Computed]
    #[OA\Property( title: "Inherited attributes", items: new OA\Items(type: AttributeData::class))]
    /** @var string[] $inherited_attributes */
    public array $inherited_attributes ;

    #[Computed]
    #[OA\Property( title: "Defined attributes", items: new OA\Items(type: AttributeData::class))]
    /** @var string[] $defined_attributes */
    public array $defined_attributes ;

    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }



}


