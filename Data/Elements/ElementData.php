<?php

namespace App\Data\ApiParams\Data\Elements;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Namespaces\UserNamespaceData;
use App\Data\ApiParams\Data\Phases\PhaseData;
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
#[OA\Schema(schema: 'Element')]
class ElementData extends Data implements IResponse
{

    public function __construct(

        #[Uuid]
        #[OA\Property(title: 'Element uuid',type: HexbatchUuid::class)]
        public string     $ref_uuid,

        #[OA\Property( title: 'Created at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $created_at,

        #[OA\Property( title: 'Updated at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $updated_at,

        #[OA\Property( title: "Type", type: ElementTypeData::class)]
        #[AutoWhenLoadedLazy]
        public ElementTypeData|Optional|Lazy|null $element_parent_type ,

        #[OA\Property( title: "Namespace", type: UserNamespaceData::class)]
        #[AutoWhenLoadedLazy]
        public UserNamespaceData|Optional|Lazy $element_namespace ,


        #[OA\Property( title: "Phase", type: PhaseData::class)]
        #[AutoWhenLoadedLazy]
        public ElementData|Optional|Lazy $element_phase,

        #[OA\Property( title: 'Data',description: "The element key value pair of attribute name, value",type: 'array',items:  new OA\Items())]
        public array|Optional|Lazy $data = []

    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }

}
