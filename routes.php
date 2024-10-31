<?php

use CooperTest\Controllers\ApostadorController;
use CooperTest\Controllers\SorteioController;

$routes = [
    [
        'endpoint' => '',
        'class' => [SorteioController::class, 'index'],
        'method' => 'GET'
    ], 
    [
        'endpoint' => '/apostadores',
        'class' => [ApostadorController::class, 'index'],
        'method' => 'GET'
    ],
    [
        'endpoint' => '/listagem',
        'class' => [ApostadorController::class, 'listing'],
        'method' => 'GET'
    ], 
    [
        'endpoint' => '/ranking',
        'class' => [ApostadorController::class, 'ranking'],
        'method' => 'GET'
    ], 
    [
        'endpoint' => '/novo-apostador',
        'class' => [ApostadorController::class, 'create'],
        'method' => 'POST'
    ],  
    [
        'endpoint' => '/deletar-apostador',
        'class' => [ApostadorController::class, 'delete'],
        'method' => 'DELETE'
    ],
    [
        'endpoint' => '/sortear',
        'class' => [SorteioController::class, 'sortear'],
        'method' => 'POST'
    ]
];