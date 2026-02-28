<?php
namespace App\Data\ApiParams\Enums;
use OpenApi\Attributes as OA;
/**
 * postgres enum type_of_location
 */
#[OA\Schema(title: "Location type")]
enum TypeOfLocation : string {
    use EnumTryTrait;
    case MAP = 'map';
    case SHAPE = 'shape';

}

