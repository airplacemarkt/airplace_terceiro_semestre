<?php
session_start();

// Destruindo a sessão
session_destroy();

// Limpando os dados da variável $_SESSION
$_SESSION = array();

// Redirecionando para a tela de login
header("Location: login.html");

exit();
?>
