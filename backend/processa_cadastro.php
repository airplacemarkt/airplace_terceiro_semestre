<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta ao banco de dados
    require_once 'conecta.php';

    // Valida os dados
    $name = $_POST['name'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        echo "As senhas não coincidem!";
        exit;
    }

    // Verifica se o e-mail já está cadastrado
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Email indicado já existe, faça login ou tente novamente";
        exit;
    }

    // Hash da senha para segurança
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insere os dados no banco
    $query = "INSERT INTO users (name, cpf, email, password) VALUES (:name, :cpf, :email, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':cpf', $cpf);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $passwordHash);
    $stmt->execute();

    //echo "Cadastro realizado com sucesso!";
    // Opcional: Redirecionar para a página de sucesso
    header("Location: cadastro_concluido.html");

    exit;

    // Fechar a conexão
    $stmt = null;
    $pdo = null;
}
?>
