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
                $query->execute(['login' => $user->name, 'password' => hash('sha256', $this->salt . $user->password), 'created' => date('Y-m-d H:i:s')]);
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }

    }

    public function getUserId(User $user): int
    {
        $query = $this->connection->prepare('SELECT `id` FROM `users` WHERE `login`=:login AND `password`=:password');
        $query->execute(['login' => $user->name, 'password' => hash('sha256', $this->salt . $user->password)]);
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getUserData(int $id): User
    {
        $query = $this->connection->prepare('SELECT * FROM `users` WHERE `id`=:id');
        $query->execute(['id' => $id]);
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $login = $data["login"];
        $password = $data["password"];
        return new User($login, $password);
    }

    public function checkUser(User $user): bool
    {
        $query = $this->connection->prepare('SELECT * FROM `users` WHERE `login`=:login AND `password`=:password');
        $query->execute(['login' => $user->name, 'password' => hash('sha256', $this->salt . $user->password)]);
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
        $query = $this->connection->prepare('INSERT INTO `currencies`(`numCode`,`letterCode`,`currencyName`,`course`,`insert_at`) VALUES(:numCode,:letterCode,:currencyName,:course,:insert_at) ');
        foreach ($data as $currency) {
            $course = str_replace(',', '.', $currency[4]);
            if ($currency[2] != 1) {
                $course = doubleval($course) / $currency[2];
            }
            $query->execute(['numCode' => intval($currency[0]), 'letterCode' => $currency[1], 'currencyName' => $currency[3], 'course' => doubleval($course), 'insert_at' => date('Y-m-d H:i:s')]);
        }
        return false;
    }

    public function refreshCurrencies(): bool
    {
        if (!$this->getLastInsertDate()) {
            return true;
        }
        $diff = date_diff(new \DateTime(), new \DateTime($this->getLastInsertDate()));
        if ($diff->h >= 3 or $diff->d >= 1) {
            return true;
        }
        return false;
    }

    public function getCurrenciesData(): array
    {
        $query = $this->connection->query('SELECT DISTINCT `id`,`numCode`,`letterCode`,`currencyName`,`course` from `currencies` ORDER BY `id` DESC');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getParticularCurrency(string $letterCode)
    {
        $query = $this->connection->prepare('SELECT DISTINCT `id`,`currencyName`,`course` from `currencies` WHERE `letterCode` = :code ORDER BY `id` DESC LIMIT 1');
        $query->execute(['code' => $letterCode]);
        return $query->fetch(PDO::FETCH_ASSOC)["course"];
    }


    private function getLastInsertDate(): string|false
    {
        $query = $this->connection->query('SELECT `id`,`insert_at` FROM `currencies` ORDER BY `id` DESC LIMIT 1');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return false;
        }
        return $data['insert_at'];
    }

    public function truncateCurrencies(): bool
    {
        $this->connection->query('TRUNCATE TABLE `currencies`');
        return true;
    }


}