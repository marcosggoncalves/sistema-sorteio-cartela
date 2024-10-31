<?php

namespace CooperTest\Controllers;

use CooperTest\Models\Apostador;
use CooperTest\Models\Cartela;
use CooperTest\Utils\Mensagens;
use CooperTest\Utils\Render;
use CooperTest\Utils\Request;

class ApostadorController
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
        $errors = [];

        $nome = isset($data['nome']) ? $data['nome'] : '';
        $numeros = isset($data['numeros']) ? $data['numeros'] : '';

        if (strlen($nome) < 3) {
            $errors[] = Mensagens::MENSAGEM_CADASTRO_APOSTADOR_VAZIO;
        }

        if (count($numeros) < 6 || count($numeros) > 6) {
            $errors[] = Mensagens::MENSAGEM_CADASTRO_APOSTADOR_QTD_NUMEROS_INVALIDOS;
        }

        if (!empty($errors)) {
            return ['errors' => $errors];
        }

        return [];
    }

    public function index()
    {
        return Render::view("apostador/index", ["title" => "Cooper Apostas", "subtitle" => 'Apostadores']);
    }

    public function listing()
    {
        $data = $this->model->listing();
        return Render::json($data, 200);
    }

    public function ranking()
    {
        $data = $this->model->ranking();
        return Render::json($data, 200);
    }

    // Exemplo Request API    
    // {
    //     "nome":"Libis da Silva1",
    //     "numeros":[1,2,34,55,67,5]
    // }
    public function create()
    {
        $data = Request::body();
        $errors = $this->validate($data);

        if (!empty($errors)) {
            return Render::json($errors, 417);
        }

        try {
            $id = $this->model->save($data['nome']);

            if ($id == 0) {
                $response = [
                    'status' => 200,
                    'mensagem' => Mensagens::MENSAGEM_ERRO_AO_SALVAR_APOSTADOR
                ];

                return Render::json($response, $response['status']);
            }

            $numeros = implode(',', $data['numeros']);

            $this->modelCartela->save($id, $numeros);

            $response = [
                'status' => 200,
                'mensagem' => Mensagens::MENSAGEM_CADASTRO_REALIZADO
            ];

            return Render::json($response, $response['status']);
        } catch (\Exception $e) {
            $response = [
                'status' => 500,
                'mensagem' => Mensagens::MENSAGEM_ERRO_AO_SALVAR_APOSTADOR . ' Error: ' . $e->getMessage()
            ];

            return Render::json($response, $response['status']);
        }
    }

    public function delete()
    {
        $query = Request::query();

        if (empty($query)) {
            $response = [
                'status' => 404,
                'mensagem' => Mensagens::MENSAGEM_ID_NAO_INFORMADO
            ];

            return Render::json($response, $response['status']);
        }

        try {
            $deletado = $this->model->delete($query['id']);

            if ($deletado) {
                $response = [
                    'status' => 200,
                    'mensagem' => Mensagens::MENSAGEM_CADASTRO_DELETADO
                ];
                return Render::json($response, $response['status']);
            }

            $response = [
                'status' => 404,
                'mensagem' => Mensagens::MENSAGEM_ERRO_AO_DELETAR_CADASTRO
            ];

            return Render::json($response, $response['status']);
        } catch (\Exception $e) {
            $response = [
                'status' => 500,
                'mensagem' => Mensagens::MENSAGEM_ERRO_AO_DELETAR_CADASTRO . ' Error: ' . $e->getMessage()
            ];
            return Render::json($response, $response['status']);
        }
    }
}
