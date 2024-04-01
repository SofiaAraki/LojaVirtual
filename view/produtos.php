<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            overflow: hidden;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        /* Estilos do cabeçalho */
        header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
        }
        header h1 {
            margin: 0;
            float: left;
        }
        nav {
            float: right;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-left: 20px;
        }
        /* Estilos do produto */
        .product {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            text-align: center; /* Centraliza o conteúdo */
        }

        .product img {
            width: 200px; /* Defina a largura desejada para todas as imagens */
            height: 200px; /* Defina a altura desejada para todas as imagens */
            object-fit: cover; /* Mantém a proporção e corta o excesso para preencher o tamanho especificado */
            border-radius: 8px;
        }

        .product h3 {
            margin-top: 10px;
            margin-bottom: 5px;
            color: #333;
        }

        .product p {
            color: #666;
        }

        .product .price {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
            display: block;
        }

        .product .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .product .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <h1>Minha Loja Virtual</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Voltar</a></li>
                <li><a href="carrinho.php">Carrinho</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="container">    
<?php
// Inclua o arquivo de conexão com o banco de dados
require_once '../model/conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Inicia a sessão PHP
session_start();

try {
    // Consulta SQL para selecionar os produtos da tabela produtos
    $query = "SELECT * FROM produtos";
    $stmt = $conn->query($query); // Prepara e executa a consulta SQL

    // Verifica se há resultados
    if ($stmt->rowCount() > 0) { // Verifica se a consulta retornou alguma linha
        // Itera sobre os resultados e exibe os produtos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Recupera cada linha de resultado como um array associativo
            echo '<div class="product">';
            echo '<img src="' . $row['Foto'] . '" alt="' . $row['Foto'] . '">'; // Exibe a imagem do produto
            echo '<h3>' . $row['Nome'] . '</h3>'; // Exibe o nome do produto
            echo '<p>' . $row['Descricao'] . '</p>'; // Exibe a descrição do produto
            echo '<span class="price">$' . $row['Preco'] . '</span>'; // Exibe o preço do produto
            // Botão para adicionar ao carrinho
            echo '<a href="../control/adicionar_carrinho.php?id=' . $row['ID'] . '" class="btn">Adicionar ao Carrinho</a>';
            echo '</div>'; // Fecha a div do produto
        }
    } else {
        echo "Nenhum produto encontrado."; // Mensagem exibida quando não há produtos na tabela
    }
} catch (PDOException $e) {
    echo "Erro ao executar a consulta: " . $e->getMessage(); // Exibe uma mensagem de erro em caso de exceção
}

// Fecha a conexão com o banco de dados
$conn = null; // Define a conexão como nula para liberar recursos
?>

</div>

</body>
</html>
