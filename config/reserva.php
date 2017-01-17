<?php

return [

    /*
    |--------------------------------------------------------------------------
    | URL do Quadro de Reservas
    |--------------------------------------------------------------------------
    |
    | Endereço da seleção de recurso do quadro de reservas para usuários que
    | não estão cadastrados no sistema
    |
    */

    'quadroUrl' => env('RESERVA_QUADRO_URL'),

    /*
    |--------------------------------------------------------------------------
    | URL de Geração de Token
    |--------------------------------------------------------------------------
    |
    | URL de acesso para criar o token de autenticação
    |
    */

    'tokenGenerateUrl' => env('RESERVA_TOKEN_GENERATE_URL'),

    /*
    |--------------------------------------------------------------------------
    | Método da Requisição da Geração de Token
    |--------------------------------------------------------------------------
    |
    | Tipo da requisição HTTP que será direcionada a URL de Geração de Token
    |
    */

    'tokenGenerateRequestMethod' => env('RESERVA_TOKEN_GENERATE_REQUEST_METHOD'),

    /*
    |--------------------------------------------------------------------------
    | URL de Login via Token
    |--------------------------------------------------------------------------
    |
    | URL de login do sistema de reserva usando token de autenticação. Deve ser
    | informado coma última barra no final do endereço.
    |
    */

    'tokenLoginUrl' => env('RESERVA_TOKEN_LOGIN_URL'),

    /*
    |--------------------------------------------------------------------------
    | Chave de Criptografia
    |--------------------------------------------------------------------------
    |
    | Chave para a criptografia de dados entre os sistemas de reserva e o Meu
    | ICEA.
    |
    */

    'chave' => env('RESERVA_CRYPT_KEY'),

    /*
    |--------------------------------------------------------------------------
    | URL de Login via Token
    |--------------------------------------------------------------------------
    |
    | URL de login do sistema de reserva usando token de autenticação. Deve ser
    | informado coma última barra no final do endereço.
    |
    */

    'algoritmo' => env('RESERVA_CRYPT_ALGORITHM'),

];