<?php

namespace App\Data\ApiParams\Data\Elements\Responses;


use App\Data\ApiParams\Common\CursoratedMetaData;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Elements\ElementValData;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'ElementReadingList')]
class ElementReadingList extends Data implements IResponse
{
    /**
     * @param Collection<ElementValData> $data
     */
    public function __construct(

        #[OA\Property( title: 'Readings',description: "list of readings",type: 'array',items:  new OA\Items(type: ElementValData::class))]
        public Collection $data,

        #[OA\Property( title: 'Meta')]
        public null|CursoratedMetaData $meta = null

    ) {
    }

    public  function findElementType(string $element_uuid, string $type_uuid) : ?ElementValData {
        foreach ($this->data as $reading) {
            if ($reading->type_uuid === $type_uuid && $reading->element_uuid === $element_uuid) {
                return $reading;
            }
        }
        return null;
    }

}

