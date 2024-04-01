<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            padding: 40px;
            width: 300px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-container form {
            display: flex;
            flex-direction: column;
        }
        .login-container label {
            margin-bottom: 10px;
            font-weight: bold;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
        }
        .login-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .login-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: #ff0000;
            margin-bottom: 20px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            overflow: hidden;
            text-align: center; /* Centraliza o conteúdo dentro da div .container */
            padding-top: 1px; /* Adiciona espaço acima do conteúdo para compensar a barra de navegação */
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
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
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
    </style>
</head>
<body>
    <?php
        // Inclui o arquivo de conexão com o banco de dados
        require_once 'conexao.php';
        
        // Define o tempo de vida da sessão em segundos
        $tempo_vida_sessao = 10; 

        // Define o tempo de vida da sessão
        session_set_cookie_params($tempo_vida_sessao);

        // Inicia a sessão
        session_start();

        // Verifica se o usuário já está logado, se estiver, redireciona para a página inicial
        if (isset($_SESSION["username"])) {
            echo "<script>alert('Usuário Logado!');</script>";
            echo '<script>window.location.href = "../index.php";</script>';
            exit;     
        }
        else {
            echo"<script> alert(Usuario não Logado!);</script>";
        }

        // Verifica se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verifica se todos os campos do formulário foram preenchidos
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                // Obtém os valores do formulário
                $username = $_POST['username'];
                $password = $_POST['password'];
                
                try {
                    // Consulta SQL para verificar se o usuário está registrado no banco de dados
                    $stmt = $conn->prepare("SELECT username , password FROM usuarios WHERE username = ?");
                    $stmt->execute([$username]); // Passa o parâmetro diretamente para o método execute
                    $user_row = $stmt->fetch(); // Obtém a próxima linha de resultados como um array associativo
                
                    if ($user_row) {
                        // Armazena a senha hash do banco de dados em uma variável separada
                        $stored_password = $user_row['password'];
                
                        // Verifica se a senha está correta
                        if (password_verify($password, $stored_password)) {
                            // Senha correta, redirecionar para a página inicial ou página desejada
                            $_SESSION["username"] = $user_row['username'];
                            echo '<script>window.location.href = "../index.php";</script>'; // Redireciona para a página inicial após o login
                            exit;
                        } else {
                            $error_message = "Senha incorreta.";
                        }
                    } else {
                        $error_message = "Usuário não registrado. Por favor, registre-se primeiro.";
                    }
                } catch (PDOException $e) {
                    // Em caso de erro, exibe a mensagem de erro
                    $error_message = "Erro de conexão: " . $e->getMessage();
                }
            }
        }
    ?>

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
    <div class="login-container">
        <h2>Login</h2>
        <?php if(isset($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Entrar">
        </form>
        <div class="register-link">
            <p>Não tem uma conta? <a href="register.php">Registre-se</a>.</p>
        </div>
    </div>
</body>
</html>