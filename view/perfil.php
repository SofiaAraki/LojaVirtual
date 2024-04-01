<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Definição do tipo de conteúdo e codificação -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
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
        /* Estilos do perfil */
        .profile {
            margin-top: 20px;
        }
        .profile-info {
            margin-bottom: 10px;
        }
        .profile-info label {
            font-weight: bold;
        }
        .edit-profile button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .edit-profile button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
<!-- Cabeçalho da página -->
<header>
    <div class="container">
        <h1>Minha Loja Virtual</h1>
        <!-- Navegação -->
        <nav>
            <ul>
                <li><a href="../index.php">Voltar</a></li>
            </ul>
        </nav>
    </div>
</header>
<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuarios'])) {
} else {
    // Se o usuário não estiver autenticado, redirecionar para a página de login
    header('Location: ../model/login.php');
    exit; // Encerrar o script após o redirecionamento
}

// Incluir o arquivo de conexão com o banco de dados
require_once '../model/conexao.php';

// Definir variáveis para armazenar os dados do usuário
$username = '';
$password = '';

try {
    // Configurar PDO para lançar exceções em caso de erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para selecionar as informações do usuário
    $sql = "SELECT username, password FROM usuarios WHERE id = 1"; // Supondo que o ID do usuário seja 1

    // Preparar e executar a consulta
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Verificar se a consulta retornou algum resultado
    if ($stmt->rowCount() > 0) {
        // Obter os dados do usuário
        $row = $stmt->fetch();
        $username = $row["username"];
        $password = $row["password"];
    } else {
        echo "Nenhum resultado encontrado.";
    }
} catch(PDOException $e) {
    echo "Erro ao executar a consulta: " . $e->getMessage();
}

// Fechar a conexão
$conn = null;
?>


<!-- Container principal -->
<div class="container">
    <!-- Título do perfil -->
    <h1>Perfil do Usuário</h1>
    <!-- Seção de informações do perfil -->
    <div class="profile">
        <!-- Informações do perfil -->
        <div class="profile-info">
            <label for="username">Nome de Usuário:</label>
            <!-- Exibição do nome de usuário -->
            <p id="username"><?php echo isset($username) ? $username : ''; ?></p>
        </div>
        <div class="profile-info">
            <label for="password">Senha:</label>
            <!-- Exibição da senha -->
            <p id="password"><?php echo isset($password) ? $password : ''; ?></p>
        </div>
        <!-- Botão para editar o perfil -->
        <div class="edit-profile">
            <button onclick="editProfile()">Editar Perfil</button>
        </div>
        <div class="edit-profile">
            <button onclick="encerrarSessao()">Encerrar Sessão</button>
        </div>
    </div>
</div>

<!-- Script para a função de editar perfil -->
<script>
    function editProfile() {
        // Simulação de uma função para edição de perfil
        alert("Implemente a lógica de edição de perfil aqui!");
    }

    function encerrarSessao() {
        // Limpa todos os dados de sessão armazenados
        document.cookie = 'PHPSESSID' + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        
        document.cookie = 'phpMyAdmin' + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        
        document.cookie = 'pma_lang' + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        
        
        // Redireciona o usuário para a página inicial
        window.location.href = "../index.php";
    }
</script>
</body>
</html>
