<?php

namespace App\Data\ApiParams\Data\User\Params;



use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
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
class NamespaceParamData extends Data implements IResponse
{

    use FromRequest;

    public function __construct(


        #[Max(60),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property( title: 'User Name', type: HexbatchResourceName::class,
            example: [new OA\Examples(summary: "user name example", value:'will_fart') ]

        )]
        public string $username,



        #[OA\Property(  title: 'Public key',type: 'string',minLength: 10,
            example: [new OA\Examples(summary: "optional public key to show data later", value:'any public key') ]
        )]
        public Optional|string|null $public_key = null

    ) {
    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }



}
