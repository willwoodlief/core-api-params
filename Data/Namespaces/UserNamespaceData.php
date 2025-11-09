<?php

namespace App\Data\ApiParams\Data\Namespaces;

use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use App\Models\UserNamespace;
use Carbon\Carbon;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'Namespace')]
class UserNamespaceData extends Data
{

    public function __construct(

        public null|int|Optional $id,

        #[OA\Property( title:"Uuid",format: 'uuid')]
        #[Uuid]
        public string $ref_uuid,

        #[OA\Property( title:"Name",type: HexbatchResourceName::class)]
        #[Max(30)]
        public string $namespace_name,

        #[OA\Property( title:"Public key")]
        public string|null $namespace_public_key,

        #[OA\Property( title:"Is system")]
        public bool $is_system,

        #[OA\Property( title:"Home set uuid",format: 'uuid')]
        #[Uuid]
        public Optional|string $home_set_uuid,

        #[OA\Property( title:"Public uuid",format: 'uuid')]
        #[Uuid]
        public Optional|string $public_uuid,

        #[OA\Property( title:"Private uuid",format: 'uuid')]
        #[Uuid]
        public Optional|string $private_uuid,

        #[OA\Property( title:"Type uuid",format: 'uuid')]
        #[Uuid]
        public Optional|string $type_uuid,


        #[OA\Property( title: 'Created', type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public ?Carbon $created_at,

        #[OA\Property( title: 'Updated', type: 'string', format: 'datetime',example: "2025-03-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public ?Carbon $updated_at,


    ) {

    }

    public static function fromModel(UserNamespace $namespace) : self
    {

        if ($namespace->home_set) {
            return self::from(
                [
                'ref_uuid'=> $namespace->ref_uuid,
                'namespace_name'=> $namespace->namespace_name,
                'namespace_public_key'=> $namespace->namespace_public_key,
                'is_system'=> $namespace->is_system,
                'created_at'=> Carbon::parse($namespace->created_at),
                'updated_at'=> Carbon::parse($namespace->updated_at),
                'home_set_uuid'=> $namespace->home_set->ref_uuid,
                'public_uuid'=> $namespace->public_element->ref_uuid,
                'private_uuid'=> $namespace->private_element->ref_uuid,
                'type_uuid'=> $namespace->namespace_base_type->ref_uuid
                ]
            );
        } else {
            return self::from(
                [
                'ref_uuid'=> $namespace->ref_uuid,
                'namespace_name'=> $namespace->namespace_name,
                'namespace_public_key'=> $namespace->namespace_public_key,
                'is_system'=> $namespace->is_system,
                'created_at'=> Carbon::parse($namespace->created_at),
                'updated_at'=> Carbon::parse($namespace->updated_at),
                ]
            );
        }

    }
}
