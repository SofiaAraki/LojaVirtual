<?php
// Inicia a sessão
session_start();

// Verifica se o ID do produto foi passado através da URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtém o ID do produto da URL e converte para um formato seguro
    $id_produtos = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Verifica se o ID do produto é um número positivo
    if($id_produtos > 0) {
        // Adiciona o ID do produto à sessão do carrinho
        $_SESSION['carrinho'][] = $id_produtos;
        
        // Redireciona de volta para a página de onde veio
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }
}

// Se o ID do produto não for válido, redireciona de volta para a página de onde veio
header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>
