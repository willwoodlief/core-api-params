<?php

namespace App\Data\ApiParams\Data\Elements\Responses;


use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'ElementList')]
class ElementReading extends Data implements IResponse
{

    public function __construct(

        #[Uuid]
        #[OA\Property(title: 'Uuid',type: HexbatchUuid::class)]
        public string $element_uuid ,

        #[Uuid]
        #[OA\Property(title: 'Uuid',type: HexbatchUuid::class)]
        public string $type_uuid ,

        #[OA\Property(title: 'Type name')]
        public string $type_name ,

        #[OA\Property( title: 'Data',description: "key value pair of attribute name, value",type: 'array',items:  new OA\Items())]
        public array $data,
    ) {
    }

}

