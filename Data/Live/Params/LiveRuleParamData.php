<?php

namespace App\Data\ApiParams\Data\Live\Params;



use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\OpenApi\Common\Resources\HexbatchResource;
use App\Data\ApiParams\Rules\ValidateTypeRef;
use App\Enums\Types\TypeOfLiveRulePolicy;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Show details about an attribute
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'LiveRuleParamData')]
class LiveRuleParamData extends Data implements IResponse
{

    use FromRequest;

    public function __construct(


        #[OA\Property(title: 'Type trigger',type: HexbatchResource::class)]
        public string                             $type_trigger,


        #[OA\Property(title: 'Type about',type: HexbatchResource::class)]
        public string                             $type_target,

        #[OA\Property(title: 'Live rule policy')]
        public TypeOfLiveRulePolicy    $live_rule_policy ,

        #[OA\Property(title: 'Is passive',
            description: "if true, then live does not modify rules or data on the element. Its attributes can be to store meta about element, but only read/written by set group")]
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

    ) {
    }


    public static function rules(ValidationContext $context): array
    {
        return [
            'type_trigger' => new ValidateTypeRef(),
            'type_target' => new ValidateTypeRef(),
        ];
    }



}
