<?php
session_start();
include 'db_config.php'; // Incluindo o arquivo de conexão com o banco de dados

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Se o usuário não estiver logado, redireciona para a página de login
    exit();
}

// Consultar pedidos do usuário
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM vendas WHERE usuario_id = $usuario_id ORDER BY data_venda DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos</title>
    <link rel="stylesheet" href="estilos_/meus_pedidos.css">
</head>
<body>

    <div class="container">
        <h1>Meus Pedidos</h1>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th># Pedido</th>
                        <th>Data</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($pedido = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $pedido['id']; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($pedido['data_venda'])); ?></td>
                            <td>R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?></td>
                            <td><?php echo ucfirst($pedido['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Você ainda não fez nenhum pedido.</p>
        <?php endif; ?>

    </div>

</body>
</html>
