<?php

namespace App\Data\ApiParams\Data\Phases;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Types\ElementTypeData;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
 * Phase
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'PhaseData')]
class PhaseData extends Data implements IResponse
{

    public function __construct(

        #[Uuid]
        #[OA\Property(title: 'Phase uuid',type: HexbatchUuid::class)]
        public Optional|string|null $ref_uuid,

        #[OA\Property(title: 'Is default phase')]
        public bool|Optional $is_default_phase,

        #[OA\Property( title:"Is system")]
        public bool|Optional $is_system,

        ///older b
        #[Max(30),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property(title: 'Name', description: 'Name of the phase',type: HexbatchResourceName::class)]
        public null|string|Optional $phase_name ,


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
        public ElementTypeData|Optional|Lazy $phase_type ,


        #[OA\Property( title: "Edited by phase", type: PhaseData::class)]
        #[AutoWhenLoadedLazy]
        public PhaseData|Optional|Lazy $edited_by_phase

    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }


    public static function fromRequest(Request $what): PhaseData
    {
        $info = $what->request->all();
        if (empty($info)) {
            $info = $what->getPayload()->all();
        }
        $there =  PhaseData::factory()
            ->withoutOptionalValues()
            ->from($info);

        PhaseData::validate($there->toArray());

       return $there;

    }
}
