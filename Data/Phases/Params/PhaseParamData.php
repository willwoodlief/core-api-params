<?php

namespace App\Data\ApiParams\Data\Phases\Params;



use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\OpenApi\Common\HexbatchResourceName;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Show details about an attribute
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Phase params')]
class PhaseParamData extends Data implements IResponse
{

    use FromRequest;
    public function __construct(


        #[Max(60),Min(3),Regex('/^\p{L}[\p{L}0-9_]{2,29}$/')]
        #[OA\Property( title: 'User Name', type: HexbatchResourceName::class,
            example: [new OA\Examples(summary: "user name example", value:'will_fart') ]

        )]
        public string               $name,



        #[Uuid]
        #[OA\Property(title: 'From type',
            description: 'Phases have an editor.',
            type: HexbatchUuid::class)]
        public string $editing_phase_ref ,

    ) {
    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }



}
