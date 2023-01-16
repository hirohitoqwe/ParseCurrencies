<?php

namespace Controller;

use Components\Validator;
use DB\DB;
use Model\User;


class UserController
{
    public function __construct(private readonly array $request, private readonly DB $db)
    {
        session_start();
    }

    public function registration(): void
    {
        if (!Validator::validate($this->request)) {
            echo 'bad request';
        } else {
            $user = new User($this->request['login'], $this->request['password']);
            if (!$this->db->createNewUser($user)) {
                $_SESSION['reg_error'] = 'Invalid Arguments';
            } else {
                header('Location:/');
            }
        }
    }

    public function auth(): void
    {
        if (!Validator::validate($this->request)) {
            $_SESSION['auth_error'] = 'Invalid Validate';
        } else {
            $user = new User($this->request['login'], $this->request['password']);
            if (!$this->db->checkUser($user)) {
                $_SESSION['auth_error'] = 'Invalid Arguments';
                header('Location:/');
            } else {
                $_SESSION['auth'] = "authorization";
                CurrencyController::refreshCurrencies($this->db);
                header('Location:/home');
            }
        }
    }
}