<?php

namespace App\Data\ApiParams\Data\Schedules;


use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Rules\ValidateCronString;
use App\Data\ApiParams\Rules\ValidateTimeZone;
use App\Helpers\AttributeConstants;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
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

#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Schedule')]
class Schedule extends Data implements IResponse
{
    /**
     * @param Optional|Lazy|Collection<int, ScheduleSpan> $time_spans
     */
    public function __construct(

        #[Max(30),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property(ref: '#/components/schemas/HexbatchResourceName',title: 'Name', description: 'Name of the bound')]
        public string|Optional $bound_name,

        #[OA\Property( title: 'Starting at',description: "Optional Iso 8601 datetime", format: 'datetime',example: "2025-01-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM, setTimeZone: AttributeConstants::OUTPUT_TIMEZONE)]
        public null|Optional|Carbon $bound_start,

        #[OA\Property( title: 'Stopping at',description: "Optional Iso 8601 datetime", format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM, setTimeZone: AttributeConstants::OUTPUT_TIMEZONE)]
        public null|Optional|Carbon $bound_stop,

        #[OA\Property(title: 'Cron', description: 'Optional linux cronjob tab string', type: '#/components/schemas/HexbatchCron')]
        public null|Optional|string $bound_cron,


        #[OA\Property(title: 'Cron Timezone', description: 'The timezone the cron is running in')]
        public null|Optional|string $bound_cron_timezone,


        #[OA\Property(title: 'Cron period length', description: 'The amount of seconds after each cron match',minimum: 1)]
        #[Max(60*60*25*366),Min(1)]
        public null|Optional|int $bound_period_length ,

        #[Uuid]
        #[OA\Property(title: 'Schedule uuid',type: HexbatchUuid::class)]
        public Optional|string $uuid,

        #[AutoWhenLoadedLazy]
        #[OA\Property( title: 'Time spans',description: "the generated time spans",items:  new OA\Items(type: ScheduleSpan::class))]
        public Optional|Collection|Lazy $time_spans

    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'bound_cron_timezone' => new ValidateTimeZone(),
            'bound_cron' => new ValidateCronString(),
        ];
    }

    public static function fromRequest(Request $what): Schedule
    {
        $info = $what->request->all();


        if (($info['bound_start']??null) !== null)
        {
            try {
                $info['bound_start'] = Carbon::parse($info['bound_start'])->toIso8601String();
            } catch (InvalidFormatException $e) {
                throw ValidationException::withMessages([
                    'bound_start' => "Cannot convert bound start time to iso8601: ". $e->getMessage(),
                ]);
            }
        }

        if (($info['bound_stop']??null) !== null)
        {
            try {
                $info['bound_stop'] = Carbon::parse($info['bound_stop'])->toIso8601String();
            } catch (InvalidFormatException $e) {
                throw ValidationException::withMessages([
                    'bound_stop' => "Cannot convert bound stop time to iso8601: ". $e->getMessage(),
                ]);
            }
        }
        return self::validateAndCreate($info);

    }
}
