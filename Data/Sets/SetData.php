<?php

namespace App\Data\ApiParams\Data\Sets;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Elements\ElementData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\AutoWhenLoadedLazy;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Attributes\WithCast;
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
#[OA\Schema(schema: 'Set')]
class SetData extends Data implements IResponse
{



    /**
     * @param Lazy|Optional|Collection<int, SetData> $children_sets
     * @param Lazy|Optional|Collection<int, ElementData> $element_members
    */
    public function __construct(


        #[Uuid]
        #[OA\Property(title: 'Set uuid',type: HexbatchUuid::class)]
        public Optional|string|null $ref_uuid ,

        #[OA\Property(title: 'Defining element')]
        public ElementData|Lazy|Optional $defining_element,


        #[OA\Property(title: 'Has events')]
        public bool $has_events  ,

        #[OA\Property( title:"Is system")]
        public bool|Optional $is_system,

        #[OA\Property(title: 'Parent Set')]
        public SetData|Lazy|Optional $parent_set   ,


        #[OA\Property( title: 'Children sets', type: 'array', items: new OA\Items(type: SetData::class))]
        #[AutoWhenLoadedLazy]
        /**
         * @var SetData[] $children_sets
         */
        public Collection|Optional|Lazy $children_sets,


        #[OA\Property( title: 'Children sets', type: 'array', items: new OA\Items(type: ElementData::class))]
        #[AutoWhenLoadedLazy]
        /**
         * @var ElementData[] $element_members
         */
        public Collection|Optional|Lazy $element_members,




        #[OA\Property( title: 'Created at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $created_at,

        #[OA\Property( title: 'Updated at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $updated_at






    ) {

    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }


    public static function fromRequest(Request $what): SetData
    {
        $info = $what->request->all();
        if (empty($info)) {
            $info = $what->getPayload()->all();
        }
        $there =  SetData::factory()
            ->withoutOptionalValues()
            ->from($info);

        SetData::validate($there->toArray());

       return $there;

    }
}
