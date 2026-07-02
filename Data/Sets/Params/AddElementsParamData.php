<?php

namespace App\Data\ApiParams\Data\Sets\Params;




use App\Data\ApiParams\Common\IResponse;
use App\Data\ApiParams\Data\Elements\Params\SelectElementParamData;
use App\Data\ApiParams\Data\FromRequest;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Create a set from an element
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Add elements to set')]
class AddElementsParamData extends Data implements IResponse
{

    use FromRequest;
    public function __construct(

        #[OA\Property(title: 'Element selection',description: 'Any elements the namespace can see can be put into the set')]
        public SelectElementParamData $selection,

        #[OA\Property(title: 'Is sticky',description: 'Sticky elements are not discarded when a set is emptied')]
        public bool                   $is_sticky = true,


    ) {

    }


    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }



}
