<?php

namespace App\Data\ApiParams\Data\Types\Responses;


use App\Data\ApiParams\Common\CursoratedMetaData;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Attributes\AttributeData;
use App\Data\ApiParams\Data\Types\ElementTypeData;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'ElementTypeList')]
class ElementTypeList extends Data implements IResponse
{
    /**
     * @param Collection<ElementTypeData>|Optional $data
     */
    public function __construct(

        #[OA\Property( title: 'Types',description: "list of types",type: 'array',items:  new OA\Items(type: ElementTypeData::class))]
        public Collection|Optional $data,

        #[OA\Property( title: 'Meta')]
        public CursoratedMetaData $meta

    ) {
    }

}

