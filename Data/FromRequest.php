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
        return static::MakingUsingCodeArray($info);
    }

    public static function MakingUsingCodeArray(array|object $info): static
    {

        $there =  static::factory()
            ->withoutOptionalValues()
            ->from($info);

        static::validate($there);

        return $there;
    }
}
