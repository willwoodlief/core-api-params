<?php

namespace App\Data\ApiParams\OpenApi\Common\Resources;

use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'HexbatchNamespace',
    title: 'A namespace ',
    description: 'A namespace has the same rules as a resource, and is used to organize resources',
    type: 'string',
    maxLength: 36,
    minLength: 3,
    oneOf: [
        new OA\Schema(type: HexbatchResourceName::class),
        new OA\Schema(type: HexbatchUuid::class)
    ]
)]
class HexbatchNamespace
{


}
