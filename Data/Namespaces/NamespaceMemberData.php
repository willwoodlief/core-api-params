<?php

namespace App\Data\ApiParams\Data\Namespaces;

use App\Data\ApiParams\Data\FromRequest;
use Carbon\Carbon;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'Member of namespace')]
class NamespaceMemberData extends Data
{
    use FromRequest;
    public function __construct(


        #[OA\Property( title:"Is admin")]
        public bool $is_admin,


        #[OA\Property( title:"Member namespace uuid",format: 'uuid')]
        #[Uuid]
        public Optional|string|null $member_namespace_uuid,

        #[OA\Property( title:"Parent namespace uuid",format: 'uuid')]
        #[Uuid]
        public Optional|string|null $parent_namespace_uuid,


        #[OA\Property(title: 'Namespace of member')]
        public UserNamespaceData|Lazy|Optional|null $namespace_member = null,


        #[OA\Property( title: 'Created', type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public ?Carbon $created_at = null,

        #[OA\Property( title: 'Updated', type: 'string', format: 'datetime',example: "2025-03-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public ?Carbon $updated_at = null


    ) {

    }


}
