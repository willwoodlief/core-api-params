<?php

namespace App\Data\ApiParams\Data\User\Response;



use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\OpenApi\Common\HexbatchToken;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Information after a login
 */
#[TypeScript]
#[OA\Schema(schema: 'Login Response')]
class LoginResponseData extends Data implements IResponse
{



    public function __construct(


        #[OA\Property(title: 'Message')]
        public string $message,

        #[OA\Property(title: 'Auth Token', type: HexbatchToken::class)]
        public string $auth_token,

        #[OA\Property(title: 'When the current token expires',format: 'date-time')]
        public ?string $token_expires_at = null

    ) {
    }

}
