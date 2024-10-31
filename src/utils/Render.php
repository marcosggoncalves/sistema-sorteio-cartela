<?php

namespace CooperTest\Utils;

class Render
{
    public static function view(string $view, array $data = [])
    {
        $file = __DIR__ . '../../views/' . $view . '.php';

        if (file_exists($file)) {
            extract($data, EXTR_SKIP);
            include_once $file;
            return;
        }

        return  self::render404();
    }

    public static function json(array $data = [], int $code = 200)
    {
        header('Content-Type: application/json');
        http_response_code($code);
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
        return; 
    }

    private static function render404()
    {
        echo Mensagens::MENSAGEM_404;
        http_response_code(404);
    }
}
