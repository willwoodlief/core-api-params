<?php

namespace App\Data\ApiParams\Data\Namespaces\Params;



use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Show details about an attribute
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Namespace params')]
class ListNamespacesParamData extends Data implements IResponse
{

    use FromRequest;

    public function __construct(

        #[OA\Property( title:"Base Handle uuid",format: 'uuid')]
        #[Uuid]
        public Optional|string|null $base_handle_uuid = null,

        #[OA\Property( title:"Link uuid to home",format: 'uuid')]
        #[Uuid]
        public Optional|string|null $link_uuid = null,

        #[OA\Property( title:"I am admin of",default: false)]
        public null|bool|Optional $is_admin,

        #[OA\Property( title:"I am member of",default: false)]
        public null|bool|Optional $is_member,

        #[OA\Property( title: 'Cursor')]
        public Optional|null|string $cursor = null

    ) {
    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }



}
