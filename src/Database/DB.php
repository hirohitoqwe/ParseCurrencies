<?php

namespace DB;

use Model\User;
use EnvConfig;
use PDO;

class DB
{
    private PDO $connection;
    private array $info;
    private string $salt = '1sJg3hfdf';
    public function __construct()
    {
        $this->info = EnvConfig::configure();
        $info = $this->info;//для лучшей читаемости
        $this->connection = new PDO(sprintf("%s:host=%s;dbname=%s", $info['driver'], $info['host'], $info['dbname']), $info['user'], $info['password']);
    }

    public function createNewUser(User $user): bool
    {
        try {
            if ($this->checkUserLoginExists($user)) {
                $query = $this->connection->prepare('INSERT INTO `users`(`login`,`password`,`created_at`) VALUES(:login,:password,:created)');
                $query->execute(['login' => $user->name, 'password' => hash('sha256',$this->salt.$user->password), 'created' => date('Y-m-d H:i:s')]);
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }

    }

    public function checkUser(User $user): bool
    {
        $query = $this->connection->prepare('SELECT * FROM `users` WHERE `login`=:login AND `password`=:password');
        $query->execute(['login' => $user->name,'password'=>hash('sha256',$this->salt.$user->password)]);
        if (count($query->fetchAll()) != 0) {
            return true;
        }
        return false;
    }

    public function checkUserLoginExists(User $user): bool
    {
        $query = $this->connection->prepare('SELECT * FROM `users` WHERE `login`=:login');
        $query->execute(['login' => $user->name]);
        if (count($query->fetchAll()) != 0) {
            return false;
        }
        return true;
    }

    public function insertCurrencies(array $data): bool
    {
        return false;
    }

}