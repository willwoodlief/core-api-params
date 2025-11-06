<?php

namespace App\Data\ApiParams\Common;


use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'CursoratedMetaData')]
class CursoratedMetaData extends Data
{
    public function __construct(

        #[OA\Property]
        public int $per_page,

        #[OA\Property]
        public string|null $next_cursor,

        #[OA\Property]
        public string|null $next_page_url,

        #[OA\Property]
        public string|null $prev_cursor,

        #[OA\Property]
        public string|null $prev_page_url,


    ) {
    }

}

/*
 export interface IPaginatedResponse<T> {
    data: T[];
    links: PaginationLink[];
    meta: IPaginatedMeta;
}


export interface ICursoratedMeta {
    per_page: number;
    next_cursor: string | null;
    next_page_url: string | null;
    prev_cursor: string | null;
    prev_page_url: string | null;
}


export interface ICursorResponse<T> {
    data: T[];
    links: undefined;
    meta: ICursoratedMeta;
}
 */
