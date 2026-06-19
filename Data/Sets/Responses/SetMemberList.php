<?php

namespace App\Data\ApiParams\Data\Sets\Responses;


use App\Data\ApiParams\Common\CursoratedMetaData;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Sets\SetMemberData;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'SetMemberList')]
class SetMemberList extends Data implements IResponse
{
    /**
     * @param Collection<SetMemberData>|Optional $data
     */
    public function __construct(

        #[OA\Property( title: 'Members',description: "list of element members",type: 'array',items:  new OA\Items(type: SetMemberData::class))]
        public Collection|Optional $data,

        #[OA\Property( title: 'Meta')]
        public CursoratedMetaData $meta

    ) {
    }

}

