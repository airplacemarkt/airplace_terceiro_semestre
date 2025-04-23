<?php
session_start();
include 'conecta.php'; // conexão com banco

// Verifica se o usuário está logado
if (!isset($_SESSION['nome'])) {
    header('Location: login.html');
    exit();
}

// Processar o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_cliente = $_SESSION['nome'];
    $id_usuario = $_SESSION['id']; // Certifique-se que você salva o ID do usuário na sessão!
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $entrega = $_POST['entrega'];
    $pagamento = $_POST['pagamento'];
    $total = 0;

    foreach ($_SESSION['carrinho'] as $item) {
        $total += $item['valor'] * $item['quantidade'];
    }

    // Inserir pedido
    $stmt = $pdo->prepare("INSERT INTO pedidos (id_usuario, nome_cliente, endereco, cep, entrega, pagamento, total) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$id_usuario, $nome_cliente, $endereco, $cep, $entrega, $pagamento, $total]);

    $id_pedido = $pdo->lastInsertId();

    // Inserir itens do pedido
    foreach ($_SESSION['carrinho'] as $item) {
        $stmt = $pdo->prepare("INSERT INTO itens_pedido (id_pedido, nome_produto, valor, quantidade) VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_pedido, $item['nome'], $item['valor'], $item['quantidade']]);
    }

    // Limpa o carrinho
    unset($_SESSION['carrinho']);

    // Redireciona para confirmação
    header("Location: pedido_confirmado.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra</title>
    <link rel="stylesheet" href="estilos_/finalizar.css">
</head>
<body>
<header>
        <div class="header-container">
            <div class="logo">
                <img src="imagens_/drone_banner_white.png" alt="Logo AirPlace">
            </div>
            <p class="inicio"><a class="inicio" href="tela_inicial.php">Início</a></p>
        </div>
    </header>
    <div class="conteiner-finalizacao">
        <h1 class="titulo-pagina">Finalizar Compra</h1>

        <h2 class="titulo-secao">Resumo do Carrinho</h2>
        <ul class="lista-carrinho">
            <?php
            $total = 0;
            foreach ($_SESSION['carrinho'] as $item):
                $subtotal = $item['valor'] * $item['quantidade'];
                $total += $subtotal;
            ?>
                <li class="item-carrinho">
                    <?php echo $item['nome']; ?> - R$ <?php echo number_format($item['valor'], 2, ',', '.'); ?> x <?php echo $item['quantidade']; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <p class="valor-total"><strong>Total: R$ <?php echo number_format($total, 2, ',', '.'); ?> (Frete Grátis)</strong></p>

        <form method="post" class="formulario-finalizacao">
            <label for="endereco">Endereço de Entrega:</label>
            <textarea id="endereco" name="endereco" required></textarea>

            <label for="cep">CEP:</label>
            <input id="cep" type="text" name="cep" required>

            <label for="entrega">Tipo de Entrega:</label>
            <select id="entrega" name="entrega" required>
                <option value="Normal">Entrega Normal</option>
                <option value="Drone">Entrega com Drone</option>
            </select>

            <label>Forma de Pagamento:</label>
            <div class="opcoes-pagamento">
                <label><input type="radio" name="pagamento" value="Pix" required> Pix</label>
                <label><input type="radio" name="pagamento" value="Boleto"> Boleto</label>
                <label><input type="radio" name="pagamento" value="Cartão de Crédito"> Cartão de Crédito</label>
            </div>

            <div class="botoes-finalizacao">
                <button type="submit" class="botao-confirmar">Confirmar Pedido</button>
                <a href="produtos.php" class="botao-cancelar">Cancelar Compra</a>
            </div>
        </form>
    </div>
</body>
</html>
