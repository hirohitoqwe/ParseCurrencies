<?php

namespace Model;

class User
{
    public function __construct(public string $name, public string $password)
    {

    }
}