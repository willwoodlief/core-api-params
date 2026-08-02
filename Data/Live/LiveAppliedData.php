<?php

namespace App\Data\ApiParams\Data\Live;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Elements\ElementData;
use App\Data\ApiParams\Data\Sets\SetData;
use App\Data\ApiParams\Data\Types\ElementTypeData;
use App\Enums\Types\TypeOfLiveRulePolicy;
use Carbon\Carbon;
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
 * Phase
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'LiveAppliedData')]
class LiveAppliedData extends Data implements IResponse
{

    public function __construct(



        #[OA\Property( title:"Is enabled")]
        public bool|Optional|null $is_live_enabled,

        #[Uuid]
        #[OA\Property(title: 'Element uuid',type: HexbatchUuid::class)]
        public string                             $ref_uuid,



        #[Uuid]
        #[OA\Property(title: 'Element uuid',type: HexbatchUuid::class)]
        public ?string                             $live_applied_element_uuid,

        #[Uuid]
        #[OA\Property(title: 'Element uuid',type: HexbatchUuid::class)]
        public ?string                             $live_applied_type_uuid,

        #[Uuid]
        #[OA\Property(title: 'Element uuid',type: HexbatchUuid::class)]
        public ?string                             $live_applied_set_uuid,

        #[OA\Property(title: 'Live rule policy')]
        public TypeOfLiveRulePolicy    $live_rule_policy ,

        #[OA\Property(title: 'Is passive',
            description: "if true, then live does not modify rules or data on the element. Its attributes can be to store meta about element, but only read/written by set group")]
        public bool                             $is_passive,

        #[OA\Property( title: 'Created at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon               $created_at,

        #[OA\Property( title: 'Updated at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $updated_at,


        #[OA\Property( title: "Live rule trigger", type: ElementTypeData::class)]
        #[AutoWhenLoadedLazy]
        public ElementData|Optional|Lazy|null $live_apply_element ,

        #[OA\Property( title: "Live rule target", type: ElementTypeData::class)]
        #[AutoWhenLoadedLazy]
        public ElementTypeData|Optional|Lazy|null $live_apply_type ,

        #[OA\Property( title: "Live rule target", type: ElementTypeData::class)]
        #[AutoWhenLoadedLazy]
        public SetData|Optional|Lazy|null $live_apply_set ,

        #[OA\Property( title: "Live rule target", type: ElementTypeData::class)]
        #[AutoWhenLoadedLazy]
        public LiveAppliedData|Optional|Lazy|null $live_apply_mask ,



    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }

}
