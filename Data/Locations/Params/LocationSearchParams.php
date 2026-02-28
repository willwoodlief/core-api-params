<?php

namespace App\Data\ApiParams\Data\Locations\Params;


use App\Data\ApiParams\Rules\ValidateResourceRef;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'LocationSearchParams')]
class LocationSearchParams extends Data
{
    public function __construct(

        #[Max(40),Min(3)]
        #[OA\Property(title: 'Namespace',description: 'The location is in this namespace. Can be uuid or name.')]
        public null|string|Optional $namespace_ref = null,

        #[OA\Property( title: 'Cursor')]
        public Optional|null|string $cursor = null

    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'namespace_ref' => new ValidateResourceRef()
        ];
    }


    public static function fromRequest(Request $what): LocationSearchParams
    {
        $info = $what->request->all();




        LocationSearchParams::validate($info);

        return  LocationSearchParams::factory()
            ->withoutOptionalValues()
            ->from($info);

    }
}
