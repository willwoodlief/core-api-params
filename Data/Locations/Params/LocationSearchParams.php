<?php

namespace App\Data\ApiParams\Data\Locations\Params;


use App\Data\ApiParams\Data\FromRequest;
use App\Data\ApiParams\Rules\ValidateResourceRef;
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
    use FromRequest;
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



}
