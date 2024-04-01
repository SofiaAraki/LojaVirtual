<?php
session_start();

// Verifica se o ID do produto foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produtos'])) {
    // Recupera o ID do produto
    $id_produtos = $_POST['id_produtos'];

    // Remove o produto do carrinho
    if (($key = array_search($id_produtos, $_SESSION['carrinho'])) !== false) {
        unset($_SESSION['carrinho'][$key]);
    }

    // Redireciona de volta para a página do carrinho após remover o produto
    header('Location: ../view/carrinho.php');
    exit;
} else {
    // Se o ID do produto não foi enviado via POST, redireciona de volta para a página inicial
    header('Location: ../index.php');
    exit;
}
?>
