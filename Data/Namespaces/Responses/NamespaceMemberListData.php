<?php

namespace App\Data\ApiParams\Data\Namespaces\Responses;


use App\Data\ApiParams\Common\CursoratedMetaData;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Namespaces\NamespaceMemberData;
use App\Data\ApiParams\Data\Namespaces\UserNamespaceData;
use App\Data\ApiParams\Data\Schedules\Schedule;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'NamespaceList')]
class NamespaceMemberListData extends Data implements IResponse
{
    /**
     * @param Collection<NamespaceMemberData>|Optional $data
     */
    public function __construct(

        #[OA\Property( title: 'Members',description: "list of namespaces",type: 'array',items:  new OA\Items(type: NamespaceMemberData::class))]
        public Collection|Optional $data,

        #[OA\Property( title: 'Meta')]
        public CursoratedMetaData $meta

    ) {
    }

}

