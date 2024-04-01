<?php
// Inclui o arquivo de configuração
require_once 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

$con = new Database(); // Cria uma nova instância da classe Database
$link = $con->getConexao(); // Obtém a conexão com o banco de dados

$smtm = $link->prepare("select * from produtos"); // Prepara a consulta SQL para selecionar todos os produtos
$smtm->execute(); // Executa a consulta SQL

$data = $smtm->fetchAll(); // Obtém todas as linhas de resultados como uma matriz associativa

print_r($data); // Imprime os dados retornados da consulta


