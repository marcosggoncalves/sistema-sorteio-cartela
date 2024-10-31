<?php

namespace CooperTest\Models;

use CooperTest\Config\Database;
use CooperTest\Utils\Mensagens;

use PDOException;
use PDO;

class Apostador
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function save(string $nome)
    {
        $query = "INSERT INTO apostador (nome) VALUES (:nome)";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':nome', $nome);

        try {
            $stmt->execute();

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            return Mensagens::MENSAGEM_ERRO_AO_SALVAR_APOSTADOR . $e->getMessage();
        }
    }

    public function delete(int $id)
    {
        $query = "SELECT COUNT(*) FROM apostador WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        if (!$stmt->execute()) return false;

        $count = $stmt->fetchColumn();

        if ($count == 0) return false;

        $query = "DELETE FROM apostador WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            return Mensagens::MENSAGEM_ERRO_AO_EXCLUIR_APOSTADOR . $e->getMessage();
        }
    }

    public function listing()
    {
        $query = "SELECT a.id,  ac.id AS cartela_id, a.nome, ac.numeros 
                FROM apostador a 
                INNER JOIN apostador_cartela ac ON ac.apostador_id = a.id 
                ORDER BY a.nome asc";

        $stmt = $this->pdo->query($query);

        try {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function ranking()
    {
        $query = "SELECT ac.id AS cartela_id, apr.quantidade_acertos, a.nome, ac.numeros, apr.numeros_acertos
                FROM apostador a 
                INNER JOIN apostador_cartela ac ON ac.apostador_id = a.id 
                INNER JOIN apostador_cartela_resultado apr ON apr.cartela_id = ac.id
                ORDER BY apr.quantidade_acertos desc, a.nome asc
                LIMIT 5";

        $stmt = $this->pdo->query($query);

        try {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function listingCartelas()
    {
        $query = "SELECT a.id, ac.id AS cartela_id, a.nome, ac.numeros 
                FROM apostador a 
                INNER JOIN apostador_cartela ac ON ac.apostador_id = a.id 
                GROUP BY a.id, a.nome";

        $stmt = $this->pdo->query($query);

        try {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             return [];
        }
    }
}
