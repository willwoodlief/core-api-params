<?php

namespace App\Data\ApiParams\Data\Types;



use App\Data\ApiParams\Casts\FromArrayObjectOrString;
use App\Data\ApiParams\Casts\FromBoxToArray;
use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Attributes\AttributeData;
use App\Data\ApiParams\Data\Namespaces\UserNamespaceData;
use App\Data\ApiParams\Data\Schedules\Schedule;
use App\Data\ApiParams\Data\Server\ServerInformation;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use App\Enums\Types\TypeOfLifecycle;
use App\Models\Attribute;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\AutoWhenLoadedLazy;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapInputName;
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



    /**
     * @param Lazy|Optional|Collection<int, AttributeData> $type_exposed_attributes
     * @param Lazy|Optional|Collection<int, TypeParentData> $type_parents
     * @param Lazy|Optional|Collection<int, TypeParentData> $type_children
     * @param Lazy|Optional|Collection<int, TypeServerLevelData> $type_server_levels
    */
    public function __construct(


        #[Uuid]
        #[OA\Property(title: 'Type uuid',type: HexbatchUuid::class)]
        public Optional|string|null $ref_uuid ,


        #[Max(60),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property(title: 'Name', description: 'Name of the type',type: HexbatchResourceName::class)]
        public null|string|Optional $type_name,


        #[OA\Property( title:"Is system")]
        public bool|Optional $is_system,

        #[OA\Property( title:"Is final")]
        public bool|Optional $is_final_type,


        #[OA\Property(title: 'Lifecycle')]
        public Optional|null|TypeOfLifecycle $lifecycle,


        #[OA\Property( title: "Sum shapes", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromArrayObjectOrString::class)]
        public Optional|null|array $sum_shape_geom ,

        #[OA\Property( title: "Sum maps", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromArrayObjectOrString::class)]
        public Optional|null|array $sum_map_geom ,


        #[OA\Property( title: "Shape bounding box", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromBoxToArray::class)]
        public Optional|null|array $sum_shape_bounding_box,

        #[OA\Property( title: "Map bounding box", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromBoxToArray::class)]
        public Optional|null|array $sum_map_bounding_box ,

        #[OA\Property( title: 'Created at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $created_at,

        #[OA\Property( title: 'Updated at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $updated_at,

        #[OA\Property( title: 'Server type is from', type: ServerInformation::class)]
        #[AutoWhenLoadedLazy]
        public ServerInformation|Lazy $type_server,


        #[OA\Property( title: "Namespace", type: UserNamespaceData::class)]
        public UserNamespaceData|Optional $owner_namespace ,


        #[OA\Property( title: "Handle", type: ElementTypeData::class)]
        public ElementTypeData|Optional $type_handle ,

        #[OA\Property( title: "Schedule", type: Schedule::class)]
        public Schedule|Optional $type_schedule ,



        #[OA\Property( title: 'Attributes', description: "The attributes in the type", type: 'array', items: new OA\Items(type: AttributeData::class))]
        #[AutoWhenLoadedLazy]
        /**
         * @var AttributeData[] $type_exposed_attributes
         */
        public Collection|Optional|Lazy $type_exposed_attributes,



        #[OA\Property( title: 'Parents', description: "The parents of the type", type: 'array', items: new OA\Items(type: TypeParentData::class))]
        #[AutoWhenLoadedLazy]
        /**
         * @var TypeParentData[] $parents
         */
        public Collection|Optional|Lazy $type_parents,



        #[OA\Property( title: 'Children', description: "The immediate children of the type", type: 'array', items: new OA\Items(type: TypeParentData::class))]
        #[AutoWhenLoadedLazy]
        /**
         * @var TypeParentData[] $parents
         */
        public Collection|Optional|Lazy $type_children,

        #[OA\Property( title: 'Server permissions',  type: 'array', items: new OA\Items(type: TypeServerLevelData::class))]
        #[AutoWhenLoadedLazy]
        /**
         * @var TypeServerLevelData[] $parents
         */
        public Collection|Optional|Lazy $type_server_levels




    ) {
        $this->inherited_attributes = [];
        $this->defined_attributes = [];
        if ($this->type_exposed_attributes instanceof Lazy) {
            foreach ($this->type_exposed_attributes->toArray() as $attribute) {
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


    public static function fromRequest(Request $what): ElementTypeData
    {
        $info = $what->request->all();
        if (empty($info)) {
            $info = $what->getPayload()->all();
        }
        $there =  ElementTypeData::factory()
            ->withoutOptionalValues()
            ->from($info);

        ElementTypeData::validate($there->toArray());

       return $there;

    }
}
