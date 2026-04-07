<?php

namespace App\Data\ApiParams\Data\User\Response;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Namespaces\UserNamespaceData;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use Carbon\Carbon;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Information after me
 */
#[TypeScript]
#[OA\Schema(schema: 'Me Response')]
class MeResponseData extends Data implements IResponse
{

    public function __construct(


        #[OA\Property(title: 'User unique id',type: HexbatchUuid::class)]
        public string $ref_uuid = '',

        #[Max(60),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property(title: 'User name',type: HexbatchResourceName::class)]
        public string $username = '',


        #[OA\Property( title: 'Registrated at',description: "When the user was registered", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        #[MapInputName('created_at')]
        public null|Carbon $registered_at,

        #[OA\Property( title: 'Token expiration',description: "When the current token expires", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        /** @uses User::tokenExpiresAt() */
        public Carbon|null $token_expires_at,

        #[OA\Property(title: 'Namespace')]
        public UserNamespaceData|Lazy $default_namespace



    ) {
    }

    /** @noinspection PhpUnused */
//    public static function fromModel(User $user) : self
//    {
//
//        if ($user->currentAccessToken()) {
//            $expires_at = $user->currentAccessToken()->expires_at??null;
//        } else {
//            $expires_at = Request::user()?->currentAccessToken()?->expires_at??null;
//        }
//
//        $arr = [
//            'ref_uuid'=> $user->ref_uuid,
//            'username'=> $user->username,
//            'registered_at'=> $user->created_at,
//            'default_namespace'=>  $user->default_namespace,
//        ];
//
//        $arr[ 'token_expires_at'] =  $expires_at;
//
//        return self::from($arr);
//    }
}
