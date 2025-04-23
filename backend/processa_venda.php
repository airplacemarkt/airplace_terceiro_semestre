<?php
session_start();
require_once 'conecta.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_produto = $_POST['nome_produto'];
    $valor = $_POST['valor'];
    $preco_promocional = !empty($_POST['preco_promocional']) ? $_POST['preco_promocional'] : null;
    $descricao = $_POST['descricao'];
    $estoque = $_POST['estoque'];
    $categoria = $_POST['categoria']; // Captura a categoria
    $imagem = $_FILES['imagem']['name'];
    $user_id = $_SESSION['user_id'];

    // Lógica para mover a imagem para o diretório correto
    move_uploaded_file($_FILES['imagem']['tmp_name'], "imagens_/" . $imagem);

    // Inserir o produto no banco de dados
    $sql = "INSERT INTO vendas (nome_produto, valor, preco_promocional, descricao, estoque, categoria, imagem, user_id)
        VALUES (:nome_produto, :valor, :preco_promocional, :descricao, :estoque, :categoria, :imagem, :user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome_produto', $nome_produto);
    $stmt->bindValue(':valor', $valor);
    $stmt->bindValue(':preco_promocional', $preco_promocional);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':estoque', $estoque);
    $stmt->bindValue(':categoria', $categoria); // Adiciona a categoria
    $stmt->bindValue(':imagem', $imagem);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();

    // Redirecionar ou exibir uma mensagem de sucesso
    header("Location: produtos.php");
    exit();
}
?>
