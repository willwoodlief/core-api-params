<?php

namespace App\Data\ApiParams\OpenApi\Common\Resources;

use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'HexbatchResource',
    title: 'Resource Name or uuid that can be namespaced ',
    description: 'Names a resource',
    type: 'string',
    maxLength: 253 + 1 + 36,
    minLength: 3,
    oneOf: [
        new OA\Schema( type: HexbatchResourceName::class),
        new OA\Schema(type: HexbatchUuid::class),
        new OA\Schema(type: HexbatchNamespacedUuid::class ),
        new OA\Schema(type:  HexbatchUuidUuid::class ),
        new OA\Schema(type: HexbatchNamespacedName::class),
        new OA\Schema(type: HexbatchDomainedUuid::class ),
        new OA\Schema(type: HexbatchDomainedName::class),
    ]
)]
class HexbatchResource
{


}
