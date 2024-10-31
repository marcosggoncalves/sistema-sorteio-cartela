<?php

namespace CooperTest\Utils;

class Random {
    public static function execute($intervaloInicial, $intervaloFinal) {
        $numeros_sorteios = range($intervaloInicial, $intervaloFinal);
        shuffle($numeros_sorteios);

        $numeros =array_slice($numeros_sorteios, 0, 6);

        $resultados = [
            'resultado' =>  $numeros 
        ];

        sort($numeros);

        $resultados['resultado_ordenado'] = $numeros;

        return   $resultados;
    }
}
