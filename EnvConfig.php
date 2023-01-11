<?php

use Dotenv\Dotenv;

class EnvConfig
{
    private static $info;

    public static function configure()
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        self::$info = [
            'driver' => $_ENV['DRIVER'],
            'host' => $_ENV['HOST'],
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['USER'],
            'password' => $_ENV['PASSWORD']
        ];
        return self::$info;
    }

}