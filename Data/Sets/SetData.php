<?php

namespace App\Data\ApiParams\Data\Sets;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Elements\ElementData;
use App\Data\ApiParams\Data\Elements\Responses\ElementList;
use App\Data\ApiParams\Data\FromRequest;
use Carbon\Carbon;
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
 * Show details about a set
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Set')]
class SetData extends Data implements IResponse
{

    use FromRequest;

    /**
     * @param Lazy|Optional|Collection<int, SetData> $children_sets
     * @param Lazy|Optional|Collection<int, ElementData> $element_members
    */
    public function __construct(


        #[Uuid]
        #[OA\Property(title: 'Set uuid',type: HexbatchUuid::class)]
        public Optional|string|null $ref_uuid ,


        #[OA\Property(title: 'Has events')]
        public bool $has_events  ,

        #[OA\Property( title:"Is system")]
        public bool|Optional $is_system,


        #[OA\Property(title: 'Defining element')]
        public ElementData|Lazy|Optional|null $defining_element = null ,

        #[OA\Property(title: 'Parent Set')]
        public SetData|Lazy|Optional|null $parent_set = null    ,


        #[OA\Property( title: 'Children sets', type: 'array', items: new OA\Items(type: SetData::class))]
        #[AutoWhenLoadedLazy]
        /**
         * @var SetData[] $children_sets
         */
        public Collection|Optional|Lazy|null $children_sets = null ,


        #[OA\Property( title: 'Children sets', type: 'array', items: new OA\Items(type: ElementData::class))]
        /**
         * @var ElementData[] $element_members
         */
        public Collection|Optional|Lazy|null $element_members = null ,




        #[OA\Property( title: 'Created at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $created_at = null ,

        #[OA\Property( title: 'Updated at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $updated_at = null






    ) {

    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }



}
