<?php

namespace Controller;

use Components\Validator;
use DB\DB;
use Model\User;


class UserController
{
    public function __construct(private readonly array $request)
    {

    }

    public function registration(): void
    {
        if (!Validator::validate($this->request)) {
            echo 'bad request';
        } else {
            $db = new DB();
            $user = new User($this->request['login'], $this->request['password']);
            if (!$db->createNewUser($user)) {
                echo 'error';
            } else {
                echo 'class';
            }
        }
        //require_once 'src/view/start_page.php';
    }

    public function auth():void
    {
        if (!Validator::validate($this->request)) {
            echo 'bad request';
        } else {
            $db = new DB();
            $user = new User($this->request['login'], $this->request['password']);
            if (!$db->checkUser($user)) {
                echo 'error';
            } else {
                echo 'class';
            }
        }
    }


}