<?php

namespace App\Data\ApiParams\Data\Namespaces\Params;



use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Show details about an attribute
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Namespace params')]
class DeleteNamespacesParamData extends Data implements IResponse
{

    use FromRequest;

    public function __construct(



        #[OA\Property( title:"Permission uuid",format: 'uuid')]
        #[Uuid]
        public Optional|string|null $permission_uuid = null,

        #[OA\Property( title:"Transfer elements",default: false)]
        public Optional|bool|null $transfer_elements_to_default = false,

        #[OA\Property( title:"Transfer types",default: false)]
        public Optional|bool|null $transfer_types_to_default = false

    ) {
    }


}
