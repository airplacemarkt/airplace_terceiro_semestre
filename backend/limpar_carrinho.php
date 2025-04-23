<?php
session_start();
unset($_SESSION['carrinho']);
header("Location: produtos.php"); // ou a página que mostra o carrinho
exit();
