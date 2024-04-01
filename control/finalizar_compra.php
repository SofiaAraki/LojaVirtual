<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Finalizar Compra</h1>
        <form action="processar_compra.php" method="post">
            <!-- Campos para informações do cliente, entrega, pagamento, etc. -->
            <!-- <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required> -->
            <!-- Adicione mais campos conforme necessário -->

            <!-- Seleção de método de pagamento -->
            <label for="pagamento">Método de Pagamento:</label>
            <select id="pagamento" name="pagamento" required>
                <option value="cartao_credito">Cartão de Crédito</option>
                <option value="boleto">Boleto Bancário</option>
                <option value="Pix">Pix</option>
                <!-- Adicione mais opções de pagamento conforme necessário -->
            </select>

            <!-- Botão para enviar o formulário -->
            <button type="submit">Finalizar Compra</button>
        </form>
    </div>
</body>
</html>

