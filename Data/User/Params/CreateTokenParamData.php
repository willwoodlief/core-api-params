<?php

namespace App\Data\ApiParams\Data\User\Params;



use App\Data\ApiParams\Casts\FromArrayObjectOrString;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\OpenApi\Common\HexbatchSecondsToLive;
use App\Exceptions\HexbatchNotPossibleException;
use App\Exceptions\RefCodes;
use App\Helpers\Utilities;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\WithCastAndTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Show details about an attribute
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Registration')]
class CreateTokenParamData extends Data implements IResponse
{

    const int|float MAX_PASSTHROUGH_SIZE = 1024*20; //20k

    public function __construct(


        #[WithCastAndTransformer(FromArrayObjectOrString::class)]
        #[OA\Property( title: "Passthrough data (optional)",items: new OA\Items(),  nullable: true)]
        /** @var mixed[] $passthrough */
        public array|optional $passthrough = [],

        #[Max(HexbatchSecondsToLive::MAX_SECONDS)]
        #[Min(1)]
        #[OA\Property(title: 'Seconds to live', description: "leave empty to not have an expiration date", type: HexbatchSecondsToLive::class, nullable: true)]
        public null|Optional|int $seconds = null,



    ) {
    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }


    public static function fromRequest(Request $what): CreateTokenParamData
    {
        $passthrough = $what->toArray();
        unset($passthrough['seconds_to_live']);
        if (mb_strlen(Utilities::maybeEncodeJson($passthrough) ) > static::MAX_PASSTHROUGH_SIZE) {
            throw new HexbatchNotPossibleException(__("msg.passthrough_data_too_big",['max'=>static::MAX_PASSTHROUGH_SIZE]),
                \Symfony\Component\HttpFoundation\Response::HTTP_UNPROCESSABLE_ENTITY,
                RefCodes::BAD_LOGIN);
        }
        $seconds = $what->request->getInt('seconds_to_live');
        if ($seconds > HexbatchSecondsToLive::MAX_SECONDS || $seconds < 0) {
            throw new HexbatchNotPossibleException(__("msg.token_too_long_lived",['seconds'=>HexbatchSecondsToLive::MAX_SECONDS]),
                \Symfony\Component\HttpFoundation\Response::HTTP_UNPROCESSABLE_ENTITY,
                RefCodes::BAD_LOGIN);
        }
        $info = [
          'passthrough'=>$passthrough,
          'seconds'  => $seconds
        ];
        $there =  CreateTokenParamData::factory()
            ->withoutOptionalValues()
            ->from($info);

        CreateTokenParamData::validate($there->toArray());

       return $there;

    }
}
