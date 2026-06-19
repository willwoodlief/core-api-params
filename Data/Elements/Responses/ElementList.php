<?php

namespace App\Data\ApiParams\Data\Elements\Responses;


use App\Data\ApiParams\Common\CursoratedMetaData;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Elements\ElementData;
use App\Models\ElementSet;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'ElementList')]
class ElementList extends Data implements IResponse
{
    /**
     * @param Collection<ElementData>|Optional $data
     */
    public function __construct(

        #[OA\Property( title: 'Elements',description: "list of elements made",type: 'array',items:  new OA\Items(type: ElementData::class))]
        public Collection|Optional $data,

        #[OA\Property( title: 'Meta')]
        public null|CursoratedMetaData $meta = null

    ) {
    }

}

