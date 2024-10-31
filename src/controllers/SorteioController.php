<?php

namespace CooperTest\Controllers;

use CooperTest\Models\Apostador;
use CooperTest\Models\Cartela;
use CooperTest\Utils\Mensagens;
use CooperTest\Utils\Random;
use CooperTest\Utils\Render;
use CooperTest\Utils\Request;

class SorteioController
{
    private $model;
    private $modelCartela;

    public function __construct()
    {
        $this->model = new Apostador();
        $this->modelCartela = new Cartela();
    }

    private function validate($data)
    {
        $nomeLoteria = isset($data['nome']) ? $data['nome'] : '';
        $dataSorteio = isset($data['data']) ? $data['data'] : '';
        $numeroInicial = isset($data['inicial']) ? (int)$data['inicial'] : 0;
        $numeroFinal = isset($data['final']) ? (int)$data['final'] : 0;

        $errors = [];

        if (strlen($nomeLoteria) < 5) {
            $errors[] = Mensagens::NOME_LOTERIA_INSUFICIENTE;
        }

        if (strtotime($dataSorteio) === false) {
            $errors[] = Mensagens::DATA_SORTEIO_INVALIDA;
        }

        if ($numeroInicial < 1) {
            $errors[] = Mensagens::NUMERO_INICIAL_INVALIDO;
        }

        if ($numeroFinal > 80) {
            $errors[] = Mensagens::NUMERO_FINAL_INVALIDO;
        }

        if ($numeroFinal < $numeroInicial) {
            $errors[] = Mensagens::NUMERO_FINAL_MENOR_INICIAL;
        }

        if (!empty($errors)) {
            return ['errors' => $errors];
        }

        return [];
    }

    public function index()
    {
        return Render::view("sorteio/index", ["title" => "Cooper Apostas"]);
    }

    // Exemplo Request API
    // {
    //     "nome":"Teste",
    //     "data":"2024-11-01",
    //     "inicial": 1,
    //     "final":30
    // }
    public function sortear()
    {
        $data = Request::body();
        $errors = $this->validate($data);

        if (!empty($errors)) {
            return Render::json($errors, 417);
        }

        try {
            $apostadores = $this->model->listingCartelas();

            if (empty($apostadores)) {
                return Render::json(['mensagem' => Mensagens::MENSAGEM_LISTAGEM_APOSTADORES_VAZIA], 417);
            }

            $sorteio = Random::execute($data['inicial'], $data['final']);

            $resultadoSorteio = $sorteio['resultado'];

            $numerosSorteados = implode(',', $resultadoSorteio);

            $resultados = [];

            foreach ($apostadores as $apostador) {
                $numeros = explode(',', $apostador['numeros']);
                $acertos = array_intersect($sorteio['resultado'], $numeros);

                $resultado = [
                    'apostador' => $apostador['nome'],
                    'numeros_escolhidos' => $numeros,
                    'numeros_acertos' => array_values($acertos),
                    'numeros_sorteados' => $sorteio['resultado'],
                ];

                if (count($acertos) == 0) {
                    $resultado['mensagem'] = Mensagens::NAO_HOUVE_ACERTOS;
                }

                $resultados[] = $resultado;

                $this->modelCartela->saveResults(
                    $apostador['cartela_id'],
                    $numerosSorteados,
                    implode(',', $acertos),
                    count($acertos)
                );
            }

            $response = [
                'numerosSorteados' => $sorteio, 
                'resultados' => $resultados,
            ];

            return Render::json($response, 200);
        } catch (\Exception $e) {
            return Render::json([
                'status' => 500,
                'mensagem' => ' Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
