<?php
session_start();
include 'conecta.php'; // Conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produto = $_POST['id_produto'];
    $nome_produto = $_POST['nome_produto'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];

    // Buscar a imagem no banco de dados
    // Buscar a imagem no banco de dados
    $stmt = $pdo->prepare("SELECT imagem FROM vendas WHERE id = :id");
    $stmt->bindValue(':id', $id_produto);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $imagem = $resultado ? $resultado['imagem'] : 'padrao.jpg'; // Fallback

    $stmt->bindValue(':id', $id_produto);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    $imagem = $resultado ? $resultado['imagem'] : 'padrao.jpg'; // fallback caso não ache

    // Verifica se o carrinho já existe na sessão
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Verifica se o produto já está no carrinho
    $produto_existente = false;
    foreach ($_SESSION['carrinho'] as &$item) {
        if ($item['id_produto'] == $id_produto) {
            $item['quantidade'] += $quantidade; // Atualiza a quantidade
            $produto_existente = true;
            break;
        }
    }

    // Se o produto não existir, adiciona ao carrinho
    if (!$produto_existente) {
        $_SESSION['carrinho'][] = [
            'id_produto' => $id_produto,
            'nome' => $nome_produto,
            'valor' => $valor,
            'quantidade' => $quantidade,
            'imagem' => $imagem
        ];
    }

    header('Location: produtos.php');
    exit();
}
?>