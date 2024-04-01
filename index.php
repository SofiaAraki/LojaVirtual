<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Loja Virtual</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav {
            margin-top: 10px;
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

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(1000px, 1fr));
            grid-gap: 20px;
        }

        .banner {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 200px;
            background-position: center;
            background-size: cover;
        }

        .banner h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .banner p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .banner .btn {
            display: inline-block;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .banner .btn:hover {
            background-color: #555;
        }

        .banner-ofertas {
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTeqSWzij2POwStMXxeV9sz2o5cFsaId8dLA&usqp=CAU');
        }

        .banner-masculinas {
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2yZLnhBz-v_wOEoqQh0UmRZqW-Lz5hijS1k6fQVP5-j1dmR0u6TbAk8yol6DKhQQ2Pts&usqp=CAU');
        }

        .banner-femininas {
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8ksC8x8uXkmJbKi1YahwMpyfqANO1muQdb120wQdGqFtbL9lYaevsf2gWScBBgyPFm_U&usqp=CAU');
        }
        
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Minha Loja Virtual</h1>
            <nav>
                <ul>
                    <li><a href="model/login.php">Login | Registre-se</a></li>
                    <li><a href="index.php" onclick="showWelcomeMessage()">Home</a></li>
                    <li><a href="view/perfil.php">Perfil</a></li>
                    <li><a href="view/carrinho.php">Carrinho</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <script>
        function showWelcomeMessage() {
            alert("Bem-vindo à Minha Loja Virtual!");
        }
    </script>

    <div class="container">
        <div class="grid">
            <section class="banner banner-ofertas">
                <div class="banner-content">
                    <h2>Oferta Especial!</h2>
                    
                    <a href="view/produtos.php" class="btn">Ver Ofertas</a>
                </div>
            </section>

            <section class="banner banner-femininas">
                <div class="banner-content">
                    <h2>Roupas Femininas</h2>
                    
                    <a href="view/produtos.php" class="btn">Ver Ofertas</a>
                </div>
            </section>
            
            <section class="banner banner-masculinas">
                <div class="banner-content">
                    <h2>Roupas Masculinas</h2>
                    
                    <a href="view/produtos.php" class="btn">Ver Ofertas</a>
                </div>
            </section>
        </div>
    </div>

</body>
</html>