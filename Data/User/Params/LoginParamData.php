<?php

namespace App\Data\ApiParams\Data\User\Params;



use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Information needed to log in
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Login')]
class LoginParamData extends Data implements IResponse
{



    public function __construct(


        #[Max(60),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property( title: 'User Name', type: HexbatchResourceName::class,
            example: [new OA\Examples(summary: "user name example", value:'will_fart') ]

        )]
        public string $username,

        #[Min(10)]
        #[OA\Property(  title: 'Password',type: 'string',minLength: 10,
            example: [new OA\Examples(summary: "password set up in the registration", value:'beans_r_88good') ]
        )]
        public string $password

    ) {
    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }


    public static function fromRequest(Request $what): LoginParamData
    {
        $info = $what->request->all();
        if (empty($info)) {
            $info = $what->getPayload()->all();
        }
        $there =  LoginParamData::factory()
            ->withoutOptionalValues()
            ->from($info);

        LoginParamData::validate($there->toArray());

       return $there;

    }
}
