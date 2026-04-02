<?php

namespace App\Data\ApiParams\Common;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'HexbatchPositiveInteger',
    title: 'Positive integer',
    description: 'Must be an integer greater than zero',
    type: 'string',
    maxLength: 15,
    minLength: 1,
    pattern: '^[1-9]\d*$',
    example: [new OA\Examples(summary: "Must be one or more", value:'22') ]
)]
class HexbatchPositiveInteger
{


}

