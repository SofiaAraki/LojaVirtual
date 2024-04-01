<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os dados do formulário
    $nome = $_POST['nome'];
    // Recupere mais dados do formulário conforme necessário

    // Processa os dados (por exemplo, salva-os em um banco de dados)

    // Limpa o carrinho após a conclusão da compra
    $_SESSION['carrinho'] = array();

    // Exibe uma mensagem de confirmação da compra
    echo "<script>alert('Compra Concluída');</script>";
    header('Location: ../view/carrinho.php');
    exit;
    // Adicione mais informações de confirmação conforme necessário
} else {
    // Se os dados não foram enviados via POST, redireciona de volta para a página inicial
    header('Location: ../index.php');
    exit;
}
?>