<?php

namespace App\Data\ApiParams\Data\Attributes\Responses;


use App\Data\ApiParams\Common\CursoratedMetaData;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Attributes\AttributeData;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'AttributeList')]
class AttributeList extends Data implements IResponse
{
    /**
     * @param Collection<AttributeData>|Optional $data
     */
    public function __construct(

        #[OA\Property( title: 'Attributes',description: "list of attributes",type: 'array',items:  new OA\Items(type: AttributeData::class))]
        public Collection|Optional $data,

        #[OA\Property( title: 'Meta')]
        public CursoratedMetaData $meta

    ) {
    }

}

