<?php

namespace App\Data\ApiParams\Data\Live\Params;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
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


        #[OA\Property(title: 'Type trigger',type: HexbatchUuid::class)]
        public string                             $type_trigger,


        #[OA\Property(title: 'Type about',type: HexbatchUuid::class)]
        public string                             $type_target,

        #[OA\Property(title: 'Live rule policy')]
        public TypeOfLiveRulePolicy    $live_rule_policy ,

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
