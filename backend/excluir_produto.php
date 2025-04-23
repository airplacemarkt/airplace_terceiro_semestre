<?php
// Conectar ao banco de dados
require_once 'conecta.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar o nome da imagem associada ao produto
    $sql = "SELECT imagem FROM vendas WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        // Deletar a imagem do servidor
        $imagem = $produto['imagem'];
        if (file_exists('imagens/' . $imagem)) {
            unlink('imagens/' . $imagem); // Exclui a imagem
        }

        // Deletar o produto do banco de dados
        $sql = "DELETE FROM vendas WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        // Redirecionar após a exclusão
        header("Location: meus_produtos.php");
        exit;
    } else {
        echo "Produto não encontrado.";
    }
}
?>
