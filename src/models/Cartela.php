<?php

namespace CooperTest\Models;

use CooperTest\Config\Database;
use CooperTest\Utils\Mensagens;
use PDOException;

class Cartela
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function save(int $id, string $numeros)
    {
        $query = "INSERT INTO apostador_cartela (apostador_id,numeros) VALUES (:apostador_id, :numeros)";
        $stmt = $this->pdo->prepare($query);
        
        $stmt->bindParam(':apostador_id', $id);
        $stmt->bindParam(':numeros', $numeros);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            return error_log(Mensagens::MENSAGEM_ERRO_AO_SALVAR_APOSTADOR . $e->getMessage());
        }
    }

    public function saveResults(int $id, string $numeros_sorteados,  string $numeros_acertos, $quantidade_acertos)
    {
        $query = "INSERT INTO apostador_cartela_resultado (cartela_id,numeros_sorteados, numeros_acertos, quantidade_acertos) VALUES (:cartela_id, :numeros_sorteados, :numeros_acertos, :quantidade_acertos)";
        $stmt = $this->pdo->prepare($query);
        
        $stmt->bindParam(':cartela_id', $id);
        $stmt->bindParam(':numeros_sorteados', $numeros_sorteados);
        $stmt->bindParam(':numeros_acertos', $numeros_acertos);
        $stmt->bindParam(':quantidade_acertos', $quantidade_acertos);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            return  error_log(Mensagens::MENSAGEM_ERRO_AO_CADASTRAR_RESULTADOS . $e->getMessage());
        }
    }
}
