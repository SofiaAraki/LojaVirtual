<?php
require_once 'model/conexao.php';

// Verifica se o ID do produto foi fornecido na URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Se o ID do produto não foi fornecido ou não é válido, redireciona para a página de produtos
    header('Location: view/produtos.php');
    exit;
}

try {
    // Consulta SQL para buscar os detalhes do produto com o ID fornecido
    $query = "SELECT * FROM produtos WHERE id = :id";

    // Prepara e executa a consulta
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();

    // Recupera os detalhes do produto
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o produto foi encontrado
    if (!$produto) {
        // Se o produto não foi encontrado, redireciona para a página de produtos
        header('Location: view/produtos.php');
        exit;
    }
} catch (PDOException $e) {
    echo "Erro ao buscar os detalhes do produto: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <style>
        /* Estilos CSS para melhorar a aparência da página */
        body {
            font-family: Arial, sans-serif;
        }
        .produto {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
        }
        .produto h1 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="produto">
        <h1><?php echo $produto['nome']; ?></h1>
        <p>Preço: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
        <p>Descrição: <?php echo $produto['descricao']; ?></p>
        <!-- Aqui você pode adicionar mais detalhes do produto, como imagem, características, etc. -->
        <a href="view/produtos.php">Voltar para a lista de produtos</a>
        
        <!-- Formulário para adicionar ao carrinho -->
        <form action="adicionar_carrinho.php" method="post">
            <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">
            <button type="submit">Adicionar ao Carrinho</button>
        </form>
    </div>
</body>
</html>
