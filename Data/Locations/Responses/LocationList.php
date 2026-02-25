<?php

namespace App\Data\ApiParams\Data\Locations\Responses;


use App\Data\ApiParams\Common\CursoratedMetaData;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Locations\Location;
use App\Data\ApiParams\Data\Schedules\Schedule;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'LocationList')]
class LocationList extends Data implements IResponse
{
    /**
     * @param Collection<Schedule>|Optional $data
     */
    public function __construct(

        #[OA\Property( title: 'Locations',description: "list of locations",type: 'array',items:  new OA\Items(type: Location::class))]
        public Collection|Optional $data,

        #[OA\Property( title: 'Meta')]
        public CursoratedMetaData $meta

    ) {
    }

}

