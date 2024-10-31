<?php

namespace CooperTest\Config;

use CooperTest\Utils\Mensagens;
use PDO;
use PDOException;

class Database
{
    private $pdo;
    private static $instance = null;

    private function __construct()
    {
        $params = sprintf(
            "mysql:host=%s;dbname=%s;charset=utf8mb4",
            $_ENV['DB_HOST'],
            $_ENV['DB_DATABASE']
        );

        try {
            $this->pdo = new PDO($params, $_ENV['DB_USUARIO'], $_ENV['DB_SENHA']);

        } catch (PDOException $e) {
            throw new PDOException(Mensagens::MENSAGEM_ERRO_BANCO . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance->pdo;
    }
}
