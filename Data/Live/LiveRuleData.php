<?php

namespace App\Data\ApiParams\Data\Live;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
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
#[OA\Schema(schema: 'LiveRuleData')]
class LiveRuleData extends Data implements IResponse
{
    use FromRequest;
    public function __construct(

        #[Uuid]
        #[OA\Property(title: 'Uuid',type: HexbatchUuid::class)]
        public string                             $ref_uuid,

        #[Uuid]
        #[OA\Property(title: 'Type owner uuid',type: HexbatchUuid::class)]
        public string                             $type_owner_uuid,

        #[Uuid]
        #[OA\Property(title: 'Type trigger uuid',description: 'null means apply to all elements',type: HexbatchUuid::class)]
        public ?string                             $type_trigger_uuid,

        #[Uuid]
        #[OA\Property(title: 'Type about uuid',type: HexbatchUuid::class)]
        public string                             $type_target_uuid,



        #[OA\Property(title: 'Is passive',
            description: "if true, then no permission needed to apply target, but target does not modify element at all, just used in rules and meta")]
        public bool                             $is_passive,

        #[OA\Property(title: 'For child sets',
            description: "if true, then this rule is only for child sets created or placed into the set, and not elements. Applied to definer element")]
        public bool                             $for_child_set_definers,


        #[OA\Property(title: 'Minimum triggers',
            description: "Minimum triggers (each element) in set for this rule")]
        public int                             $live_rule_min_triggers,

        #[OA\Property(title: 'Minimum triggers',
            description: "Maximum triggers (each element) in set for this rule")]
        public int                             $live_rule_max_triggers,

        #[OA\Property(title: 'Live rule policy')]
        public TypeOfLiveRulePolicy    $live_rule_policy ,

        #[OA\Property( title: 'Created at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon               $created_at,

        #[OA\Property( title: 'Updated at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $updated_at,


        #[OA\Property( title: "Live rule owner", type: ElementTypeData::class)]
        #[AutoWhenLoadedLazy]
        /** @uses \App\Models\LiveRule::live_rule_owner() */
        public ElementTypeData|Optional|Lazy|null $live_rule_owner ,

        #[OA\Property( title: "Live rule trigger", type: ElementTypeData::class)]
        #[AutoWhenLoadedLazy]
        /** @uses \App\Models\LiveRule::live_rule_trigger() */
        public ElementTypeData|Optional|Lazy|null $live_rule_trigger ,

        #[OA\Property( title: "Live rule target", type: ElementTypeData::class)]
        #[AutoWhenLoadedLazy]
        /** @uses \App\Models\LiveRule::type_live_target() */
        public ElementTypeData|Optional|Lazy|null $type_live_target ,



    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }

}
