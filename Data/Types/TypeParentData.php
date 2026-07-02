<?php

namespace App\Data\ApiParams\Data\Types;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
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
 * Parent/Child relationships for types
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(title: 'Type Parent/Children')]
class TypeParentData extends Data implements IResponse
{

    use FromRequest;
    public function __construct(


        #[Uuid]
        #[OA\Property(title: 'Parent uuid',type: HexbatchUuid::class)]
        public Optional|string|null $ref_uuid ,

        #[OA\Property( title: 'Child', type: ElementTypeData::class)]
        #[AutoWhenLoadedLazy]
        public ElementTypeData|Lazy $child_type,

        #[OA\Property( title: 'Parent', type: ElementTypeData::class)]
        #[AutoWhenLoadedLazy]
        public ElementTypeData|Lazy $parent_type,


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



}
