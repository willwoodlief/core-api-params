<?php

namespace App\Data\ApiParams\Data\Schedules\Responses;


use App\Data\ApiParams\Data\Schedules\Schedule;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'ScheduleList')]
class ScheduleList extends Data
{
    public function __construct(

        #[OA\Property( title: 'Schedules',description: "list of schedules",items:  new OA\Items(type: Schedule::class))]
        public Collection $schedules,


        #[OA\Property( title: 'Cursor')]
        public Optional|null|string $cursor

    ) {
    }

}
