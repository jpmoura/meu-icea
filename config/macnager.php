<?php

return [

    /*
    |--------------------------------------------------------------------------
    | URL de Geração de Token
    |--------------------------------------------------------------------------
    |
    | URL de acesso para criar o token de autenticação
    |
    */

    'tokenGenerateUrl' => env('MACNAGER_TOKEN_GENERATE_URL'),

    /*
    |--------------------------------------------------------------------------
    | Método da Requisição da Geração de Token
    |--------------------------------------------------------------------------
    |
    | Tipo da requisição HTTP que será direcionada a URL de Geração de Token
    |
    */

    'tokenGenerateRequestMethod' => env('MACNAGER_TOKEN_GENERATE_REQUEST_METHOD'),

    /*
    |--------------------------------------------------------------------------
    | URL de Login via Token
    |--------------------------------------------------------------------------
    |
    | URL de login do sistema de reserva usando token de autenticação. Deve ser
    | informado coma última barra no final do endereço.
    |
    */

    'tokenLoginUrl' => env('MACNAGER_TOKEN_LOGIN_URL'),

    /*
    |--------------------------------------------------------------------------
    | Chave de Criptografia
    |--------------------------------------------------------------------------
    |
    | Chave para a criptografia de dados entre os sistemas de reserva e o Meu
    | ICEA.
    |
    */

    'chave' => env('MACNAGER_CRYPT_KEY'),

    /*
    |--------------------------------------------------------------------------
    | URL de Login via Token
    |--------------------------------------------------------------------------
    |
    | URL de login do sistema de reserva usando token de autenticação. Deve ser
    | informado coma última barra no final do endereço.
    |
    */

    'algoritmo' => env('MACNAGER_CRYPT_ALGORITHM'),

];