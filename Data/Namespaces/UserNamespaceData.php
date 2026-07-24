<?php

namespace App\Data\ApiParams\Data\Namespaces;

use App\Data\ApiParams\Data\Elements\ElementData;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\Data\Sets\SetData;
use App\Data\ApiParams\Data\Types\ElementTypeData;
use App\Data\ApiParams\Data\User\UserData;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\AutoWhenLoadedLazy;
use Spatie\LaravelData\Attributes\Validation\Max;
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
#[OA\Schema(schema: 'Namespace')]
class UserNamespaceData extends Data
{
    use FromRequest;
    /**
     * @param Lazy|null|Collection<int, NamespaceMemberData> $namespace_admins
    */
    public function __construct(


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
        public null|string $home_set_uuid,

        #[OA\Property( title:"Public uuid",format: 'uuid')]
        #[Uuid]
        public null|string $public_uuid,

        #[OA\Property( title:"Private uuid",format: 'uuid')]
        #[Uuid]
        public null|string $private_uuid,

        #[OA\Property( title:"Type uuid",format: 'uuid')]
        #[Uuid]
        public null|string $type_uuid,


        #[OA\Property( title: 'Created', type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public ?Carbon $created_at,

        #[OA\Property( title: 'Updated', type: 'string', format: 'datetime',example: "2025-03-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public ?Carbon $updated_at,

        #[AutoWhenLoadedLazy]
        #[OA\Property(title: 'Home set')]
        public SetData|Lazy|null  $home_set,

        #[AutoWhenLoadedLazy]
        #[OA\Property(title: 'Public')]
        public ElementData|Lazy|null $public_element,
//

        #[AutoWhenLoadedLazy]
        #[OA\Property(title: 'Private')]
        public ElementData|Lazy|null $private_element,

        #[AutoWhenLoadedLazy]
        #[OA\Property(title: 'Type')]
        public ElementTypeData|Lazy|null $namespace_base_type,

        public UserData|Optional|null $owner_user = null,

        #[OA\Property( title: 'Admins', description: "People who admin this", type: 'array', items: new OA\Items(type: NamespaceMemberData::class))]
        /**
         * @var NamespaceMemberData[] $namespace_admins
         */
        public Collection|Lazy|null $namespace_admins = null,







    ) {

    }

}
