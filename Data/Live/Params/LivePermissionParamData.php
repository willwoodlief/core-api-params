<?php

namespace App\Data\ApiParams\Data\Live\Params;



use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\OpenApi\Common\Resources\HexbatchResource;
use App\Data\ApiParams\Rules\ValidateTypeRef;
use Illuminate\Support\Optional;
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
class LivePermissionParamData extends Data implements IResponse
{

    use FromRequest;

    public function __construct(


        #[OA\Property(title: 'Can this add listeners?',
            description: "if true, then the live can override, mute, or add its own listeners")]
        public bool                             $can_add_listeners,

        #[OA\Property(title: 'Can this add bounds?',
            description: "if true, then the live can adjust the map and shape bounds of the element")]
        public bool                             $can_add_bounds,

        #[OA\Property(title: 'Type trigger',type: HexbatchResource::class)]
        public null|string|Optional                             $type_trigger = null,


        #[OA\Property(title: 'Type target',type: HexbatchResource::class)]
        public null|string|Optional                             $type_target = null,

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
