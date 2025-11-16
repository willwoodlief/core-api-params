<?php

namespace App\Data\ApiParams\Data\Schedules\Params;


use App\Data\ApiParams\Rules\ValidateResourceRef;
use App\Helpers\AttributeConstants;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'ScheduleSearchParams')]
class ScheduleSearchParams extends Data
{
    public function __construct(

        #[Max(40),Min(3)]
        #[OA\Property(title: 'Namespace',description: 'The schedule is in this namespace. Can be uuid or name.')]
        public null|string|Optional $namespace_ref = null,


        #[OA\Property( title: 'Scheduled before',description: "Iso 8601 datetime, to see if the schedule is before this", format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM, setTimeZone: AttributeConstants::OUTPUT_TIMEZONE)]
        public null|Optional|Carbon $before  = null,

        #[OA\Property( title: 'Scheduled before',description: "Iso 8601 datetime, to see if the schedule is after this", format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM, setTimeZone: AttributeConstants::OUTPUT_TIMEZONE)]
        public null|Optional|Carbon $after = null,

        #[OA\Property( title: 'Scheduled during',description: "Iso 8601 datetime, to see if the schedule includes this", format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM, setTimeZone: AttributeConstants::OUTPUT_TIMEZONE)]
        public null|Optional|Carbon $during = null,


        #[OA\Property( title: 'Cursor')]
        public Optional|null|string $cursor = null

    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'namespace_ref' => new ValidateResourceRef()
        ];
    }


    public static function fromRequest(Request $what): ScheduleSearchParams
    {
        $info = $what->request->all();


        foreach (['before','after','during'] as $field) {
            if (($info[$field]??null) !== null)
            {
                try {
                    $info[$field] = Carbon::parse($info[$field])->toIso8601String();
                } catch (InvalidFormatException $e) {
                    throw ValidationException::withMessages([
                        $field => __('msg.cannot_convert_time', ['field' => $field, 'msg' =>$e->getMessage() ])]);
                }
            }
        }


        ScheduleSearchParams::validate($info);

        return  ScheduleSearchParams::factory()
            ->withoutOptionalValues()
            ->from($info);

    }
}
