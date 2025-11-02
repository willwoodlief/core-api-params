<?php

namespace App\Data\ApiParams\Data\Schedules;



use App\Helpers\AttributeConstants;
use Carbon\Carbon;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'ScheduleSpan')]
class ScheduleSpan extends Data
{
    public function __construct(



        #[OA\Property( title: 'Starting at',description: "Optional Iso 8601 datetime", format: 'datetime',example: "2025-01-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM, setTimeZone: AttributeConstants::OUTPUT_TIMEZONE)]
        public null|Optional|Carbon $start = null,

        #[OA\Property( title: 'Stopping at',description: "Optional Iso 8601 datetime", format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM, setTimeZone: AttributeConstants::OUTPUT_TIMEZONE)]
        public null|Optional|Carbon $stop = null,



    ) {
    }


}
