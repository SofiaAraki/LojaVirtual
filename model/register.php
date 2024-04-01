<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Metadados -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        /* Estilos gerais do corpo da página */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2; /* Cor de fundo */
            display: flex;
            justify-content: center; /* Centraliza horizontalmente */
            align-items: center; /* Centraliza verticalmente */
            height: 100vh; /* Tamanho total da tela */
        }

        /* Estilos do contêiner do formulário de registro */
        .register-container {
            background-color: #fff; /* Cor de fundo */
            border-radius: 8px; /* Bordas arredondadas */
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Sombra */
            padding: 40px; /* Espaçamento interno */
            width: 300px; /* Largura do contêiner */
            text-align: center; /* Alinhamento do texto */
        }

        .register-container h2 {
            margin-bottom: 20px; /* Espaçamento inferior */
            color: #333; /* Cor do texto */
        }

        .register-container form {
            display: flex;
            flex-direction: column;
        }

        .register-container label {
            margin-bottom: 10px; /* Espaçamento inferior */
            font-weight: bold; /* Negrito */
        }

        .register-container input[type="text"],
        .register-container input[type="password"] {
            padding: 10px; /* Espaçamento interno */
            border: 1px solid #ccc; /* Borda */
            border-radius: 4px; /* Bordas arredondadas */
            margin-bottom: 20px; /* Espaçamento inferior */
            width: 100%; /* Largura total */
            box-sizing: border-box; /* Inclui o padding e a borda na largura */
        }

        .register-container input[type="submit"] {
            background-color: #4CAF50; /* Cor de fundo */
            color: white; /* Cor do texto */
            padding: 15px; /* Espaçamento interno */
            border: none; /* Sem borda */
            border-radius: 4px; /* Bordas arredondadas */
            cursor: pointer; /* Cursor de mão */
            font-size: 16px; /* Tamanho da fonte */
            transition: background-color 0.3s ease; /* Transição suave */
        }

        .register-container input[type="submit"]:hover {
            background-color: #45a049; /* Cor de fundo ao passar o mouse */
        }

        .error-message {
            color: #ff0000; /* Cor do texto de erro */
            margin-bottom: 20px; /* Espaçamento inferior */
        }

        /* Estilos do cabeçalho */
        header {
            background-color: #333; /* Cor de fundo */
            color: #fff; /* Cor do texto */
            padding: 20px 0; /* Espaçamento interno */
            position: fixed; /* Fixa o cabeçalho na parte superior */
            width: 100%; /* Largura total */
            top: 0; /* Posiciona no topo */
            z-index: 1000; /* Z-index para sobrepor outros elementos */
        }

        header h1 {
            margin: 0; /* Margem zero */
            float: left; /* Alinha à esquerda */
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
    <!-- Cabeçalho -->
    <header>
        <div class="container">
            <h1>Minha Loja Virtual</h1>
            <nav>
                <ul>
                    <li><a href="../index.php">Voltar</a></li> <!-- Link para voltar -->
                </ul>
            </nav>
        </div>
    </header>
    <!-- Contêiner do formulário de registro -->
    <div class="register-container">
        <h2>Registro</h2>
        <!-- Exibe a mensagem de erro, se houver -->
        <?php if(isset($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php } ?>
        <!-- Formulário de registro -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required> <!-- Campo de usuário -->
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required> <!-- Campo de senha -->
            <label for="confirm_password">Confirmar Senha:</label>
            <input type="password" id="confirm_password" name="confirm_password" required> <!-- Confirmação de senha -->
            <input type="submit" value="Registrar"> <!-- Botão de envio do formulário -->
        </form>
        <div class="register-link">
            <p>Já tem uma conta? <a href="login.php">Faça Login</a>.</p>
        </div>
    </div>
    <!-- Script PHP para lidar com o formulário de registro -->
    <?php
        // Incluir o arquivo de conexão com o banco de dados
        require_once 'conexao.php';

        // Verificar se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar se todos os campos do formulário foram preenchidos
            if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
                // Obter os valores do formulário
                $username = $_POST['username'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];

                // Verificar se as senhas coincidem
                if ($password === $confirm_password) {
                    try {
                        // Consulta SQL para verificar se o nome de usuário já está registrado
                        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
                        $stmt->execute([$username]);

                        // Verificar se o nome de usuário já existe
                        if ($stmt->rowCount() > 0) {
                            echo "<script>alert('Nome de usuário já existe. Por favor, escolha outro nome de usuário.');</script>";
                        } else {
                            // Hash da senha
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                            // Preparar e executar a consulta SQL para inserir os dados na tabela
                            $stmt = $conn->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
                            $stmt->execute([$username, $hashed_password]);

                            echo "<script>alert('Registro bem-sucedido!');</script>";
                            echo "<script>window.location.href = '../index.php';</script>"; // Redireciona para a página inicial após o registro
                            exit; // Encerra o script
                        }
                    } catch(PDOException $e) {
                        // Em caso de erro, exibir a mensagem de erro
                        echo "Erro ao registrar: " . $e->getMessage();
                    }
                } else {
                    echo "As senhas não coincidem.";
                }
            } else {
                echo "Todos os campos do formulário devem ser preenchidos.";
            }
        }
    ?>
</body>
</html>
