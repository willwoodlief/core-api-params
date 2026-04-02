<?php

namespace App\Data\ApiParams\Data\User\Response;



use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\OpenApi\Common\HexbatchToken;
use Carbon\Carbon;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Information after a login
 */
#[TypeScript]
#[OA\Schema(schema: 'Create token Response')]
class CreateTokenResponseData extends Data implements IResponse
{



    public function __construct(


        #[OA\Property(title: 'Auth Token', type: HexbatchToken::class)]
        public string $auth_token,

        #[OA\Property( title: 'Expires at',description: "When the token expires", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public null|Carbon $expires_at,

    ) {
    }

}
