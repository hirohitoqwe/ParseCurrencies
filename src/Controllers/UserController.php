<?php

class UserController
{
    public function __construct(private readonly array $request)
    {

    }

    public function index()
    {
        require_once 'src/view/start_page.php';
    }

}