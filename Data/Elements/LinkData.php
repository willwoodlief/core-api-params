<?php

namespace App\Data\ApiParams\Data\Elements;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\Data\Sets\SetData;
use Carbon\Carbon;
use OpenApi\Attributes as OA;
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
#[OA\Schema(schema: 'Link')]
class LinkData extends Data implements IResponse
{

    use FromRequest;

    public function __construct(


        #[Uuid]
        #[OA\Property(title: 'Set uuid',type: HexbatchUuid::class)]
        public Optional|string|null $ref_uuid ,

        #[OA\Property(title: 'Element from')]
        public ElementData|Lazy|Optional $linking_element,

        #[OA\Property(title: 'Set to')]
        public SetData|Lazy|Optional $linked_set,


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
