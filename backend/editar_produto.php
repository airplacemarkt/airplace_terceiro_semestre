<?php
// Conectar ao banco de dados
require_once 'conecta.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM vendas WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        echo "Produto não encontrado.";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo ao AirPlace</title>
    <link rel="stylesheet" href="estilos_/style_edit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<header>
         <div class="header-container">
                <div class="logo">
                    <img src="imagens_/drone_banner_white.png" alt="Logo AirPlace">
                </div>

                <div class="search-bar">
                    <input type="text" placeholder="BUSQUE NO AIRPLACE">
                    <button><i class="fas fa-search"></i></button>
                    <?php if (isset($_SESSION['nome'])): ?>
                    <a href="venda.php"><button class="btn-vender">Vender</button></a>
                    <?php else: ?>
                    <a href="login.html"><button class="btn-vender">Vender</button></a>
                    <?php endif; ?>
                </div>
                <div class="right-info">
                    <div class="right-top">
                        <div class="icon">
                            <span class="location-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        </div>
                        <div class="text-enter">
                            <p>Drones disponíveis na</br> minha região</p>
                        </div>
                    </div>
                    <div class="div_icones" class="dropdown">
                        <p class="icone_carrinho"><i class="fas fa-shopping-cart"></i></p>
                       <div class="dropdown">
                        <a href=""><i class="fas fa-user-circle" id="icone_perfil"></i></a>
                        <a class="link_saudacao" href="#login">Olá, <?php echo isset($_SESSION['nome']) ? $_SESSION['nome'] : 'Visitante'; ?></a>
                        <div class="dropdown-content">
                            <a href="meus_produtos.php"> Meus Produtos</a>
                            <a href="logout.php" class="btn_sair">Sair</a>
                        </div>
                    </div>

                   </div>
                    </div>
                </div>
            </div>
            <nav>
                <ul>
                       <li><a href="tela_inicial.php">Home</a></li>
                       <li><a href="sobrenos.php">Sobre nós</a></li>
                       <li><a href="ofertas.php">Ofertas</a></li>
                       <li><a href="cupons.php">Cupons</a></li>
                       <li><a href="drones.php">Conheça nossos Drones</a></li>
                       <li><a href="airplay.php">Air Play</a></li>
                </ul>
            </nav>

        </header>
       
        <div class="linha-laranja"></div>
    <main class="editar-produto">
    <h2>Editar Produto</h2>

    <form action="atualizar_produto.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($produto['id']); ?>">

        <label for="nome_produto">Nome do Produto:</label>
        <input type="text" name="nome_produto" value="<?php echo htmlspecialchars($produto['nome_produto']); ?>" required><br><br>

        <label for="valor">Valor:</label>
        <input type="text" name="valor" value="<?php echo htmlspecialchars($produto['valor']); ?>" required><br><br>

        <label for="preco_promocional">Preço Promocional (se desejar):</label>
        <input type="number" name="preco_promocional" value="<?php echo htmlspecialchars($produto['preco_promocional']); ?>" step="0.01"><br><br>


        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required><?php echo htmlspecialchars($produto['descricao']); ?></textarea><br><br>

        <label for="estoque">Estoque:</label>
        <input type="number" name="estoque" value="<?php echo htmlspecialchars($produto['estoque']); ?>" required><br><br>

        <label for="imagem">Nova Imagem (se desejar substituir):</label>
        <input type="file" name="imagem" accept="image/*"><br><br>

        <img src="imagens/<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome_produto']); ?>" width="100"><br><br>

        <button type="submit">Atualizar Produto</button>
    </form>
    </main>



</body>
</html>