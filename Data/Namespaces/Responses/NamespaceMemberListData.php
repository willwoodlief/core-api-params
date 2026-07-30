<?php

namespace App\Data\ApiParams\Data\Namespaces\Responses;


use App\Data\ApiParams\Common\CursoratedMetaData;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\Data\Namespaces\NamespaceMemberData;
use Illuminate\Support\Collection;
use Illuminate\Support\Optional;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'NamespaceMemberListData')]
class NamespaceMemberListData extends Data implements IResponse
{
    use FromRequest;
    /**
     * @param Collection<NamespaceMemberData>|Optional|null $data
     */
    public function __construct(

        #[OA\Property( title: 'Members',description: "list of namespaces",type: 'array',items:  new OA\Items(type: NamespaceMemberData::class))]
        public Collection|Optional|null $data = null,

        #[OA\Property( title: 'Meta')]
        public CursoratedMetaData|null $meta = null

    ) {
    }

}

