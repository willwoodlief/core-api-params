<?php

namespace App\Data\ApiParams\Data\Schedules\Responses;


use App\Data\ApiParams\Common\CursoratedMetaData;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Schedules\Schedule;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'ScheduleList')]
class ScheduleList extends Data implements IResponse
{
    /**
     * @param Collection<Schedule>|Optional $data
     */
    public function __construct(

        #[OA\Property( title: 'Schedules',description: "list of schedules",type: 'array',items:  new OA\Items(type: Schedule::class))]
        public Collection|Optional $data,

        #[OA\Property( title: 'Meta')]
        public CursoratedMetaData $meta

    ) {
    }

}

