<?php

namespace App\Data\ApiParams\Casts;

use App\Exceptions\HexbatchInvalidException;
use App\Helpers\Utilities;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class FromBoxToArray implements Cast,Transformer
{

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): array|Uncastable
    {
        Utilities::ignoreVar($property,$properties,$context);
        $what =  static::fromBoxtoArray($value);
        return $what?:  Uncastable::create();
    }


    public function transform(DataProperty $property, mixed $value, TransformationContext $context): mixed
    {
        Utilities::ignoreVar($property,$context);
        $what =  static::fromBoxtoArray($value);
        return $what?:  Uncastable::create();
    }

    public static function fromBoxtoArray(string|array|null $value) : null|array  {
        if (!$value) {return $value;}
        if (is_array($value)) {
            return $value;
        }

        if (is_string($value)  ) {
            if (str_contains($value,'BOX3D(')) { //BOX3D(-100 -100 -100,100 100 100)
                $output_array = [];
                $nb_ok = preg_match('/BOX3D\((?<first>[\d\-.\s]+)\s*,\s*(?<last>[\d\-.\s]+)\)/', $value, $output_array);
                if ($nb_ok) {
                    $first = explode(' ',$output_array['first']) ;
                    $last = explode(' ',$output_array['last']) ;
                    if (3 !== count($first) || 3 !== count($last)) {
                        throw new HexbatchInvalidException("invalid box3d ". $value);
                    }
                    return [
                        'first'=>['x'=>(float)$first[0],'y'=>(float)$first[1],'z'=>(float)$first[2]],
                        'last'=>['x'=>(float)$last[0],'y'=>(float)$last[1],'z'=>(float)$last[2]],
                    ];
                }//
            } else if (str_contains($value,'BOX(')) { //BOX(1.415509201162195 5.266177765992833,27.014404666132464 29.676211987671675)
                $output_array = [];
                $nb_ok = preg_match('/BOX\((?<first>[\d\-.\s]+)\s*,\s*(?<last>[\d\-.\s]+)\)/', $value, $output_array);
                if ($nb_ok) {
                    $first = explode(' ',$output_array['first']) ;
                    $last = explode(' ',$output_array['last']) ;
                    if (2 !== count($first) || 2 !== count($last)) {
                        throw new HexbatchInvalidException("invalid box ". $value);
                    }
                    return [
                        'first'=>['x'=>(float)$first[0],'y'=>(float)$first[1]],
                        'last'=>['x'=>(float)$last[0],'y'=>(float)$last[1]],
                    ];
                }
            }
        }
        return null;
    }
}
