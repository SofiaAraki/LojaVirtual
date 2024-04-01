<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
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

        /* Estilos para o conteúdo centralizado */
        .centered {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Estilos para os produtos */
        .produtos {
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 10px;
            overflow: hidden;
            background-color: #f9f9f9;
        }

        .produtos img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            margin-right: 10px;
            float: left;
        }

        .produtos h3 {
            margin: 0;
            color: #333;
            font-size: 18px;
        }

        .produtos p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }

        .produtos .price {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
            display: block;
            font-size: 16px;
        }

        .produtos form {
            margin-top: 10px;
        }

        /* Estilos para o botão */
        .btn {
            display: inline-block;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease; /* Adiciona uma transição suave ao mudar de cor */
            font-size: 14px;
        }

        .btn:hover {
            background-color: #555;
        }

        /* Estilos para o botão "Finalizar Compra" */
        .finalize-button {
            margin-top: 20px;
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
            </ul>
        </nav>
    </div>
</header>

<section class="cart">
    <div class="container">
        <h2>Carrinho de Compras</h2>
        <?php
        session_start(); // Inicia a sessão se ainda não estiver iniciada

        // Inclui o arquivo de conexão PDO
        include_once '../model/conexao.php';

        // Variável para armazenar o preço total
        $preco_total = 0;

        // Verifica se o carrinho está vazio
        if (empty($_SESSION['carrinho'])) {
            echo '<div class="centered">';
            echo '<p>O seu carrinho está vazio.</p>';
            // Adicione um botão "Adicionar Produtos" para redirecionar os usuários para a página de produtos
            echo '<a href="produtos.php" class="btn">Adicionar Produtos</a>';
            echo '</div>';
        } else {
            // Aqui você pode recuperar os detalhes dos produtos no carrinho e exibi-los
            // Exemplo de exibição dos produtos (substitua pelo seu código real):
            foreach ($_SESSION['carrinho'] as $id_produtos) {
                // Consulta SQL para recuperar os detalhes do produto com base no ID
                $sql = "SELECT * FROM produtos WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id_produtos]);
                $produtos = $stmt->fetch();

                // Verifica se encontrou um produto com o ID especificado
                if ($produtos) {
                    // Exibe os detalhes do produto
                    echo '<div class="produtos">';
                    echo '<img src="' . $produtos['Foto'] . '" alt="' . $produtos['Foto'] . '">'; // Exibe a imagem do produto
                    echo '<div class="produtos-info">';
                    echo '<h3>' . $produtos['Nome'] . '</h3>'; // Exibe o nome do produto
                    echo '<p>' . $produtos['Descricao'] . '</p>'; // Exibe a descrição do produto
                    echo '<span class="price">$' . $produtos['Preco'] . '</span>'; // Exibe o preço do produto
                    // Botão para remover o produto do carrinho
                    echo '<form action="../control/remover_carrinho.php" method="post">';
                    echo '<input type="hidden" name="id_produtos" value="' . $id_produtos . '">';
                    echo '<button type="submit">Remover do Carrinho</button>';
                    echo '</form>';
                    echo '</div>'; // Fecha a div .produtos-info
                    echo '</div>'; // Fecha a div .produtos

                    // Atualiza o preço total
                    $preco_total += $produtos['Preco'];
                }
            }

            // Exibe o preço total
            echo '<p>Preço Total: $' . number_format($preco_total, 2, ',', '.') . '</p>';

            // Link para finalizar a compra
            echo '<a href="../control/finalizar_compra.php" class="btn finalize-button">Finalizar Compra</a>';
        }
        ?>
    </div>
</section>

</body>
</html>
