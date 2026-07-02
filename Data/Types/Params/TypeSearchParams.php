<?php

namespace App\Data\ApiParams\Data\Types\Params;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Show details about an attribute
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Type search params')]
class TypeSearchParams extends Data implements IResponse
{

    use FromRequest;

    public function __construct(



        #[Uuid]
        #[OA\Property(title: 'Handle uuid',type: HexbatchUuid::class)]
        public Optional|string|null $handle_uuid ,


        #[Uuid]
        #[OA\Property(title: 'Namespace uuid',type: HexbatchUuid::class)]
        public Optional|string|null $namespace_uuid ,


        #[Uuid]
        #[OA\Property(title: 'Location uuid',type: HexbatchUuid::class)]
        public Optional|string|null $location_uuid ,


        #[Uuid]
        #[OA\Property(title: 'Schedule uuid',type: HexbatchUuid::class)]
        public Optional|string|null $schedule_uuid ,


        #[Max(60),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property(title: 'Name', description: 'Name of the type',type: HexbatchResourceName::class)]
        public null|string|Optional $type_name,


        #[OA\Property( title:"Is system",default: false)]
        public null|bool|Optional $is_system,


        #[OA\Property( title: 'Cursor')]
        public Optional|null|string $cursor = null
    ) {
    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }



}
