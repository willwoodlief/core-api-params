<?php

namespace App\Data\ApiParams\Data\Namespaces\Params;



use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\Rules\ValidateNamespaceArray;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Tell which namespaces to use
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'NamespaceSelectionParamData')]
class NamespaceSelectionParamData extends Data implements IResponse
{

    use FromRequest;

    public function __construct(


        #[OA\Property(title: 'Namespaces',description: 'The namespaces to select. ')]
        /** @var string[] $element_refs */
        public array $namespace_refs = [],

    ) {
    }


    public static function rules(ValidationContext $context): array
    {
        return [
            'namespace_refs' => new ValidateNamespaceArray(),
        ];
    }



}
