<?php

namespace App\Data\ApiParams\Data\Elements\Responses;


use App\Data\ApiParams\Common\CursoratedMetaData;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Elements\LinkData;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'ElementList')]
class LinkList extends Data implements IResponse
{
    /**
     * @param Collection<LinkData>|Optional $data
     */
    public function __construct(

        #[OA\Property( title: 'Links',description: "list of links between elements and sets",type: 'array',items:  new OA\Items(type: LinkData::class))]
        public Collection|Optional $data,

        #[OA\Property( title: 'Meta')]
        public null|CursoratedMetaData $meta = null

    ) {
    }

}

