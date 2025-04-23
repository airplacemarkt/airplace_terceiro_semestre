<?php
session_start();
include 'conecta.php';

$sql = "SELECT * FROM vendas WHERE preco_promocional IS NOT NULL AND preco_promocional < valor ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas</title>
    <link rel="stylesheet" href="estilos_/style_ofertas.css">
    <link rel="stylesheet" href="estilos_/carrinho.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .link_saudacao {
            color: white;
            text-decoration: none;
            font-weight: bolder;
        }
    </style>
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

                <div class="div_icones">
                    <?php if (isset($_SESSION['nome'])): ?>

                    <!-- Ícone e dropdown do carrinho -->
                    <div class="dropdown-carrinho-container">
                        <a href="#" class="icone_carrinho">
                            <i class="fas fa-shopping-cart"></i>
                            <?php if (!empty($_SESSION['carrinho'])): ?>
                            <span class="badge-carrinho">
                                <?php echo array_sum(array_column($_SESSION['carrinho'], 'quantidade')); ?>
                            </span>
                            <?php endif; ?>
                        </a>

                        <div class="dropdown-carrinho">
                            <?php if (!empty($_SESSION['carrinho'])): ?>
                            <?php foreach ($_SESSION['carrinho'] as $id => $item): ?>
                            <div class="item-carrinho">
                                <?php $img_src = "imagens_/" . htmlspecialchars($item['imagem']); ?>
                                <img src="<?php echo $img_src; ?>" alt="Imagem do Produto">
                                <div class="info-carrinho">
                                    <p>
                                        <?php echo htmlspecialchars($item['nome']); ?>
                                    </p>
                                    <p><strong>R$
                                            <?php echo number_format($item['valor'], 2, ',', '.'); ?>
                                        </strong></p>
                                    <p>Quantidade:
                                        <?php echo $item['quantidade']; ?>
                                    </p>

                                    <div class="acoes-carrinho">
                                        <a href="atualizar_carrinho.php?acao=adicionar&id=<?php echo $id; ?>"
                                            class="btn-acao">+</a>
                                        <a href="atualizar_carrinho.php?acao=remover&id=<?php echo $id; ?>"
                                            class="btn-acao remover">🗑️</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                            <a href="finalizar_compra.php" class="btn-finalizar">Finalizar Compra</a>
                            <a href="limpar_carrinho.php" class="btn-limpar" onclick="limparCarrinho()">Limpar
                                Carrinho</a>
                            <script>
                                function limparCarrinho() {
                                    if (confirm("Tem certeza que deseja limpar o carrinho?")) {
                                        // Redireciona para um arquivo PHP que irá limpar o carrinho
                                        window.location.href = "limpar_carrinho.php";
                                    }
                                }
                            </script>

                            <?php else: ?>
                            <p class="vazio">Carrinho vazio</p>
                            <?php endif; ?>
                        </div>
                    </div>



                    <!-- Perfil do usuário -->
                    <div class="dropdown">
                        <a href="#"><i class="fas fa-user-circle" id="icone_perfil"></i></a>
                        <a class="link_saudacao" href="#login">Olá,
                            <?php echo htmlspecialchars($_SESSION['nome']); ?>
                        </a>
                        <div class="dropdown-content">
                            <a href="meus_produtos.php">Meus Produtos</a>
                            <a href="logout.php" class="btn_sair">Sair</a>
                        </div>
                    </div>

                    <?php else: ?>
                    <p class="Login"><a href="login.html">Entre ou cadastre-se</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <nav>
            <ul>
                <li><a href="tela_inicial.php">Home</a></li>
                <li><a href="sobrenos.php">Sobre nós</a></li>
                <li><a href="produtos.php">Produtos</a></li>
                <li><a href="drones.php">Conheça nossos Drones</a></li>
                <li><a href="airplay.php">Air Play</a></li>
            </ul>
        </nav>
    </header>

    <div class="linha-laranja"></div>

    <main class="main_cupom">
        <div class="titulo_main_cupom">
            <h1>OFERTAS</h1>
            <img class="img_cupom_white" src="imagens_/img_cupom_white.png" alt="">
            <p class="p_cupom">MELHORES PREÇOS DECOLANDO!!</p>
            <img class="logo_main" src="imagens_/logo_drone_white.png" alt="">
        </div>
    </main>


    <div class="container">
        <!-- Sidebar de Filtros (com filtros iguais aos de produtos.php) -->
        <div class="sidebar">
            <h2>Filtros</h2>
            <form method="GET" action="">
                <!-- Filtro de Categoria -->
                <h3>Categoria:</h3>
                <label>
                    <input type="radio" name="categoria" value=""> Todas
                </label>
                <label>
                    <input type="radio" name="categoria" value="drones"> Drones
                </label>
                <label>
                    <input type="radio" name="categoria" value="cameras"> Câmeras
                </label>
                <label>
                    <input type="radio" name="categoria" value="fones"> Fones de Ouvido
                </label>

                <!-- Filtro de Preço -->
                <h3>Preço:</h3>
                <div class="price-range">
                    <input type="number" name="preco_min" placeholder="Min" />
                    <input type="number" name="preco_max" placeholder="Max" />
                </div>


                <!-- Botão de Filtragem -->
                <button type="submit" class="filter-button">Filtrar</button>
            </form>
        </div>

        <!-- Lista de Ofertas -->
        <main class="ofertas">
            <?php if ($stmt->rowCount() > 0): ?>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="card-oferta">
                <img src="imagens_/<?= htmlspecialchars($row['imagem']); ?>"
                    alt="<?= htmlspecialchars($row['nome_produto']); ?>">
                <h2>
                    <?= htmlspecialchars($row['nome_produto']); ?>
                </h2>
                <p>
                    <?= htmlspecialchars($row['descricao']); ?>
                </p>
                <p class="preco">
                    <span>R$
                        <?= number_format($row['valor'], 2, ',', '.'); ?>
                    </span>
                    R$
                    <?= number_format($row['preco_promocional'], 2, ',', '.'); ?>
                </p>
                <button class="btn-comprar" onclick="adicionarAoCarrinho(<?= $row['id_produto']; ?>)">Adicionar ao
                    Carrinho</button>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <p>Nenhuma oferta disponível no momento.</p>
            <?php endif; ?>
        </main>
    </div>

    <footer>
        <div class="footer-links">
            <ul>
                <li><a href="#">Trabalhe conosco</a></li>
                <li><a href="#">Termos e condições</a></li>
                <li><a href="#">Como cuidamos da sua privacidade</a></li>
                <li><a href="#">Contato</a></li>
            </ul>
        </div>
        <div class="footer-info">
            <p>CNPJ nº 00.000.000/0000-00 / Av. das Nações Unidas, nº 3.203, Bonfim, Osasco/SP - CEP 00000-000 - empresa
                do grupo AIR PLACE</p>
        </div>
    </footer>
</body>

</html>