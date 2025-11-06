<?php

namespace App\Data\ApiParams\OpenApi\Common\Resources;

use App\Data\ApiParams\OpenApi\Common\Resources\Attributes\HexbatchDomainTypeAttribute;
use App\Data\ApiParams\OpenApi\Common\Resources\Attributes\HexbatchDomainTypeUuid;
use App\Data\ApiParams\OpenApi\Common\Resources\Attributes\HexbatchDomainUuidAttribute;
use App\Data\ApiParams\OpenApi\Common\Resources\Attributes\HexbatchDomainUuidUuid;
use App\Data\ApiParams\OpenApi\Common\Resources\Attributes\HexbatchNamespaceTypeAttribute;
use App\Data\ApiParams\OpenApi\Common\Resources\Attributes\HexbatchNamespaceTypeUuid;
use App\Data\ApiParams\OpenApi\Common\Resources\Attributes\HexbatchNamespaceUuidAttribute;
use App\Data\ApiParams\OpenApi\Common\Resources\Attributes\HexbatchNamespaceUuidUuid;
use App\Data\ApiParams\OpenApi\Common\Resources\Attributes\HexbatchUuidTypeAttribute;
use App\Data\ApiParams\OpenApi\Common\Resources\Attributes\HexbatchUuidTypeUuid;
use App\Data\ApiParams\OpenApi\Common\Resources\Attributes\HexbatchUuidUuidAttribute;
use App\Data\ApiParams\OpenApi\Common\Resources\Attributes\HexbatchUuidUuidUuid;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'HexbatchAttribute',
    title: 'Attribute that is defined by a namespace:type:attribute in name or uuid parts ',
    description: 'Names an attribute',
    type: 'string',
    maxLength: 253 + 1 + 36 + 1 + 36,
    minLength: 3 + 1 + 3 + 1 + 3,
    oneOf: [

        new OA\Schema(type: HexbatchNamespacedUuid::class),
        new OA\Schema( type: HexbatchUuidUuid::class),
        new OA\Schema(type: HexbatchNamespacedName::class),


        new OA\Schema(type: HexbatchNamespaceTypeAttribute::class),
        new OA\Schema(type: HexbatchNamespaceTypeUuid::class ),
        new OA\Schema(type: HexbatchNamespaceUuidAttribute::class ),
        new OA\Schema(type: HexbatchNamespaceUuidUuid::class ),
        new OA\Schema(type: HexbatchUuidTypeAttribute::class ),
        new OA\Schema(type: HexbatchUuidTypeUuid::class ),
        new OA\Schema(type: HexbatchUuidUuidAttribute::class ),
        new OA\Schema(type: HexbatchUuidUuidUuid::class ),

        new OA\Schema(type: HexbatchDomainTypeAttribute::class ),
        new OA\Schema(type: HexbatchDomainTypeUuid::class ),
        new OA\Schema(type: HexbatchDomainUuidAttribute::class ),
        new OA\Schema(type: HexbatchDomainUuidUuid::class ),
    ]
)]
class HexbatchAttribute
{


}
