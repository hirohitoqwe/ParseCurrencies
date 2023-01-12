<?php

namespace Components;

class Validator
{
    public static function validate(array $request): bool
    {
        if (!isset($request['login'], $request['password'])) {
            return false;
        }

        return true;
    }
}