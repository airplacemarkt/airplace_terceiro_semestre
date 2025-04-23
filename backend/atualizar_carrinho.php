<?php
session_start();

if (isset($_GET['acao']) && isset($_GET['id'])) {
    $acao = $_GET['acao'];
    $id = $_GET['id'];

    if (isset($_SESSION['carrinho'][$id])) {
        if ($acao == 'adicionar') {
            $_SESSION['carrinho'][$id]['quantidade'] += 1;
        } elseif ($acao == 'remover') {
            $_SESSION['carrinho'][$id]['quantidade'] -= 1;

            // Se a quantidade for 0 ou menos, remove o item do carrinho
            if ($_SESSION['carrinho'][$id]['quantidade'] <= 0) {
                unset($_SESSION['carrinho'][$id]);
            }
        }
    }
}

// Redireciona de volta para a página do carrinho
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
