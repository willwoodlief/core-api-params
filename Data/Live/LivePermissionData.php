<?php

namespace App\Data\ApiParams\Data\Live;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\Data\Namespaces\UserNamespaceData;
use App\Data\ApiParams\Data\Types\ElementTypeData;
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
#[OA\Schema(schema: 'LivePermissionData')]
class LivePermissionData extends Data implements IResponse
{
    use FromRequest;
    public function __construct(

        #[Uuid]
        #[OA\Property(title: 'Uuid',type: HexbatchUuid::class)]
        public string                             $ref_uuid,

        #[OA\Property( title: "Permission giver", type: UserNamespaceData::class)]
        #[AutoWhenLoadedLazy]
        public UserNamespaceData|Optional|Lazy $permission_giver ,


        #[OA\Property( title: "Permission trigger", type: ElementTypeData::class)]
        #[AutoWhenLoadedLazy]
        public ElementTypeData|Optional|Lazy|null $permission_trigger ,


        #[OA\Property( title: "Permission target", type: ElementTypeData::class)]
        #[AutoWhenLoadedLazy]
        public ElementTypeData|Optional|Lazy|null $permission_target ,


        #[OA\Property(title: 'Can this add listeners?',
            description: "if true, then the live can override, mute, or add its own listeners")]
        public bool                             $can_add_listeners,

        #[OA\Property(title: 'Can this add bounds?',
            description: "if true, then the live can adjust the map and shape bounds of the element")]
        public bool                             $can_add_bounds,


        #[OA\Property( title: 'Created at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon               $created_at,

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

}
