<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedido Confirmado</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            padding: 50px;
        }
        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid green;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
            margin: auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg);}
            100% { transform: rotate(360deg);}
        }
    </style>
</head>
<body>
    <h1>Processando seu pedido...</h1>
    <div class="loader"></div>

    <script>
        setTimeout(function(){
            document.body.innerHTML = `
                <h1>✅ Pedido concluído com sucesso!</h1>
                <p>Em breve enviaremos a confirmação por e-mail.</p>
                <a href="tela_inicial.php">Voltar à Home</a>
            `;
        }, 3000);
    </script>
</body>
</html>
