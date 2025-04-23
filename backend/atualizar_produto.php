<?php
// Conectar ao banco de dados
require_once 'conecta.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome_produto = $_POST['nome_produto'];
    $preco_promocional = !empty($_POST['preco_promocional']) ? $_POST['preco_promocional'] : null;  // Novo campo
    $valor = $_POST['valor'];
    $descricao = $_POST['descricao'];
    $estoque = $_POST['estoque'];

    // Recuperar os dados do produto antes da atualização
    $sql = "SELECT imagem FROM vendas WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se uma nova imagem foi enviada, processá-la
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        // Deletar a imagem antiga, se existir
        $imagem_antiga = $produto['imagem'];
        if (file_exists('imagens_/' . $imagem_antiga)) {
            unlink('imagens_/' . $imagem_antiga);
        }

        // Processar nova imagem
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nome_imagem = uniqid('produto_') . '.' . $ext;
        $caminho_imagem = 'imagens_/' . $nome_imagem;

        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem)) {
            echo "Erro ao fazer upload da nova imagem.";
            exit;
        }
    } else {
        // Se não houver nova imagem, manter a imagem antiga
        $nome_imagem = $produto['imagem'];
    }

    // Atualizar os dados no banco (incluindo preco_promocional)
    $sql = "UPDATE vendas SET nome_produto = ?, valor = ?, preco_promocional = ?, descricao = ?, estoque = ?, imagem = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome_produto, $valor, $preco_promocional, $descricao, $estoque, $nome_imagem, $id]);

    // Redirecionar após a atualização
    header("Location: produtos.php");
    exit;
}
?>
