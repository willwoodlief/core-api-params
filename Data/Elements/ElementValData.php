<?php

namespace App\Data\ApiParams\Data\Elements;


use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[OA\Schema(schema: 'ElementValData')]
class ElementValData extends Data implements IResponse
{
    use FromRequest;
    public function __construct(

        #[Uuid]
        #[OA\Property(title: 'Element uuid',type: HexbatchUuid::class)]
        public string $element_uuid ,

        #[Uuid]
        #[OA\Property(title: 'Set uuid',type: HexbatchUuid::class)]
        public ?string $set_uuid ,

        #[Uuid]
        #[OA\Property(title: 'Type uuid',type: HexbatchUuid::class)]
        public string $type_uuid ,

        #[Uuid]
        #[OA\Property(title: 'Namespace uuid',type: HexbatchUuid::class)]
        public string $namespace_uuid ,

        #[OA\Property(title: 'Type name')]
        public string $type_name ,

        #[OA\Property(title: 'Namespace name')]
        public string $namespace_name ,

        #[OA\Property( title: 'Data',description: "key value pair of attribute name, value",type: 'array',items:  new OA\Items(type: ElementValData::class))]
        public array $data,
    ) {
    }

}

