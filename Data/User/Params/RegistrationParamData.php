<?php

namespace App\Data\ApiParams\Data\User\Params;



use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\Data\Namespaces\Params\NamespaceParamData;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Show details about an attribute
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Registration')]
class RegistrationParamData extends Data implements IResponse
{

    use FromRequest;

    public function __construct(


        #[OA\Property(  title: 'Namespace',description: "The namespace name and optional public key")]
        public NamespaceParamData $namespace,

        #[Min(10)]
        #[OA\Property(  title: 'Password',type: 'string',minLength: 10,
            example: [new OA\Examples(summary: "password set up in the registration", value:'beans_r_88good') ]
        )]
        public string $password,


    ) {
    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }



}
