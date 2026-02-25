<?php

namespace App\Data\ApiParams\Data\Locations;



use App\Data\ApiParams\Casts\FromArrayObjectOrString;
use App\Data\ApiParams\Casts\FromBoxToArray;
use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Namespaces\UserNamespaceData;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use App\Enums\Bounds\TypeOfLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithCastAndTransformer;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Show details about a map or shape
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Location')]
class Location extends Data implements IResponse
{

    public function __construct(


        #[Max(30),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property(title: 'Name', description: 'Name of the bound',type: HexbatchResourceName::class)]
        public null|string|Optional $bound_name = null,

        #[OA\Property(title: 'Location Type')]
        public ?TypeOfLocation $location_type = null,

        #[Uuid]
        #[OA\Property(title: 'Location uuid',type: HexbatchUuid::class)]
        public Optional|string|null $ref_uuid = null,




        #[OA\Property( title: "Geo Json", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromArrayObjectOrString::class)]
        public ?array $geo_json = null,

        #[OA\Property( title: "Display", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromArrayObjectOrString::class)]
        public ?array $location_display = null,

        #[OA\Property( title: "Shape bounding box", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromBoxToArray::class)]
        public ?array $shape_bounding_box = null,

        #[OA\Property( title: "Map bounding box", items: new OA\Items(), nullable: true)]
        #[WithCastAndTransformer(FromBoxToArray::class)]
        public ?array $map_bounding_box = null,


        #[OA\Property( title: 'Created at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $created_at = null,

        #[OA\Property( title: 'Created at',description: "When this was created", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Optional|Carbon $updated_at = null,

        #[OA\Property( title: "Namespace", type: UserNamespaceData::class)]
        public UserNamespaceData|null|Optional $location_namespace = null

    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }


    public static function fromRequest(Request $what): Location
    {
        $info = $what->request->all();
        if (empty($info)) {
            $info = $what->getPayload()->all();
        }

        Location::validate($info);

        return  Location::factory()
            ->withoutOptionalValues()
            ->from($info);

    }
}
