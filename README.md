# Projeto Teste

Este é um projeto teste que utiliza Node.js e PHP.

## Pré-requisitos

- Node.js v20.11.0
- PHP 8.3.1
- Composer

## Banco de dados
O banco de dados utilizado foi o postgres. Crie o banco de dados "pokemons". Se seu postgres estiver executando em localhost:5432, o projeto já estará configurado. Altere o arquivo api/.env caso necessário

## Rodando o Projeto front com Node.js (Vue.js)

1. Navegue até a pasta `frontend`:
   ```bash
   npm install
   
2. inicie o projeto:
   ```bash
   npm run dev

No terminal aparecerá a porta do servidor (http://localhost:portaX). Este é o projeto a ser acessado via navegador

## Rodando a api em PHP
1. Na pasta /api, renomear o arquivo .env.example para .env
2. Na pasta /api, execute os comandos
   ```bash
   composer install
   php artisan migrate
   php artisan serve

A api PHP estará disponível em http://localhost:8000.

No projeto também possui vídeos de apresentação na pasta "videos".

Certifique-se de ter as versões corretas do Node.js e PHP instaladas.

Certifique-se de que as portas estejam disponíveis para a execução dos sistemas.
