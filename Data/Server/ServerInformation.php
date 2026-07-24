<?php

namespace App\Data\ApiParams\Data\Server;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\Data\Namespaces\UserNamespaceData;
use App\Data\ApiParams\Data\Types\ElementTypeData;
use App\Enums\Server\TypeOfServerStatus;
use App\Models\ElementType;
use Carbon\Carbon;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\AutoWhenLoadedLazy;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
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
 * Show details about a server
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Server')]
class ServerInformation extends Data implements IResponse
{

    use FromRequest;

    public function __construct(


        #[Uuid]
        #[OA\Property(title: 'Server uuid',type: HexbatchUuid::class)]
        public Optional|string|null $ref_uuid ,


        #[Max(20000)]
        public null|string|Optional $server_description,



        #[OA\Property(title: 'Name')]
        #[Max(30),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        public null|string|Optional $server_name,

        #[OA\Property(title: 'Domain',description: "the domain of the server, no protocol or query string")]
        #[Max(255),Min(3),Regex('/^\p{L}[\p{L}0-9_\-.]{2,255}$/')]
        public null|string|Optional $server_domain,

        #[OA\Property(title: 'Url',description: "the url of the server, no query string")]
        #[Max(255),Min(3),Regex('/^\p{L}[\p{L}0-9_\-.:\/]{2,255}$/')]
        public null|string|Optional $server_url,

        #[OA\Property(title: 'Server version',description: "the software version")]
        public null|string|Optional $server_version,

        #[OA\Property(title: 'Server time',description: "When the version happened", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00")]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $server_version_time,

        #[OA\Property(title: 'Install time',description: "When the version was installed", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00")]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $server_install_time,

        #[OA\Property(title: 'Status')]
        public Optional|TypeOfServerStatus|null $server_status ,



        #[OA\Property( title: 'Created at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $created_at,

        #[OA\Property( title: 'Updated at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $updated_at,

        #[OA\Property( title: 'Status updated at',description: "When last status changed", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $status_change_at,



        #[AutoWhenLoadedLazy]
        #[OA\Property( title: "Namespace", type: UserNamespaceData::class)]
        public UserNamespaceData|Optional|Lazy $owning_namespace,

        #[AutoWhenLoadedLazy]
        #[OA\Property( title: "Namespace", type: ElementType::class)]
        public ElementTypeData|Optional|Lazy $server_type


    ) {

    }



    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }



}
