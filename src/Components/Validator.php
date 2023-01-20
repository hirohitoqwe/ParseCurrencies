<?php

namespace Components;

class Validator
{
    public static function validate(array $request): bool
    {
        if (!isset($request['login'], $request['password']) or strlen($request['password']) < 5 or !trim($request['password']) or !trim($request['login'])) {
            return false;
        }

        return true;
    }
}