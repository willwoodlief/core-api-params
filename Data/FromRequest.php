<?php

namespace App\Data\ApiParams\Data;


use Illuminate\Http\Request;

trait FromRequest
{
    public static function fromRequest(Request $what): static
    {
        $info = $what->request->all();
        if (empty($info)) {
            $info = $what->getPayload()->all();
        }
        return static::makingUsingCodeArray($info);
    }

    public static function makingUsingCodeArray(array|object $info): static
    {

        $there =  static::factory()
            ->withoutOptionalValues()
            ->from($info);

        static::validate($there);

        return $there;
    }
}
