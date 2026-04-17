<?php

namespace App\Data\ApiParams\Data\Elements\Params;




use App\Data\ApiParams\Common\HexbatchUuid;
use App\Data\ApiParams\Common\IResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


/**
 * Create one of more elements from the same type
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Select elements')]
class SelectElementParamData extends Data implements IResponse
{


    public function __construct(

        #[OA\Property(title: 'Elements',description: 'The elements to select. ')]
        /** @var string[] $element_refs */
        public array $element_refs = [],


        #[Uuid]
        #[OA\Property(title: 'Type',description: 'The types elements are made from',type: HexbatchUuid::class)]
        public ?string $type_ref = null,

        #[Uuid]
        #[OA\Property(title: 'Set',description: 'The set which will have the elements',type: HexbatchUuid::class)]
        public ?string $set_ref = null,

        #[Uuid]
        #[OA\Property(title: 'Phase',description: 'The phase to restrict this selection',type: HexbatchUuid::class)]
        public ?string $phase_ref = null,


        #[Uuid]
        #[OA\Property(title: 'Namespace', description: 'The elements owned by this namespace', type: HexbatchUuid::class)]
        public ?string $namespace_ref = null,

        #[Uuid]
        #[OA\Property(title: 'Attribute',description: 'The selected elements have this attribute',type: HexbatchUuid::class)]
        public ?string $attribute_ref = null,

    ) {

    }

    public function isEmptyElementSelection() :bool {
        if (count($this->element_refs)) {return false;}
        if ($this->type_ref) {return false;}
        if ($this->set_ref) {return false;}
        if ($this->phase_ref) {return false;}
        if ($this->namespace_ref) {return false;}
        return true;
    }

    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }


    public static function fromRequest(Request $what): SelectElementParamData
    {
        $info = $what->request->all();
        if (empty($info)) {
            $info = $what->getPayload()->all();
        }
        $there =  SelectElementParamData::factory()
            ->withoutOptionalValues()
            ->from($info);

        SelectElementParamData::validate($there->toArray());

       return $there;

    }
}
