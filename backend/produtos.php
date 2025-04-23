<?php
session_start(); // Inicia a sessão
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="estilos_/produtos.css">
    <link rel="stylesheet" href="estilos_/carrinho.css">
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
                                <p><?php echo htmlspecialchars($item['nome']); ?></p>
                                <p><strong>R$ <?php echo number_format($item['valor'], 2, ',', '.'); ?></strong></p>
                                <p>Quantidade: <?php echo $item['quantidade']; ?></p>

                                <div class="acoes-carrinho">
                                    <a href="atualizar_carrinho.php?acao=adicionar&id=<?php echo $id; ?>" class="btn-acao">+</a>
                                    <a href="atualizar_carrinho.php?acao=remover&id=<?php echo $id; ?>" class="btn-acao remover">🗑️</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

            <a href="finalizar_compra.php" class="btn-finalizar">Finalizar Compra</a>
            <a href="limpar_carrinho.php" class="btn-limpar" onclick="limparCarrinho()">Limpar Carrinho</a>
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
                    <a class="link_saudacao" href="#login">Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?></a>
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
            <li><a href="ofertas.php">Ofertas</a></li>
            <li><a href="drones.php">Conheça nossos Drones</a></li>
            <li><a href="airplay.php">Air Play</a></li>
        </ul>
    </nav>
</header>

    <div class="linha-laranja"></div>

    <div class="container">
        <div class="sidebar">
            <h2>Filtros</h2>
            <form method="GET" action="">
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

                <h3>Preço:</h3>
                <div class="price-range">
                    <input type="number" name="preco_min" placeholder="Min" />
                    <input type="number" name="preco_max" placeholder="Max" />
                </div>

                <button type="submit" class="filter-button">Filtrar</button>
            </form>
        </div>

        <main class="products">
            <?php
            include 'conecta.php';

            // Define o SQL base para buscar todos os produtos
            $sql = "SELECT * FROM vendas";
            
            // Verifica se há filtros
            $conditions = [];
            $params = [];
            
            if (!empty($_GET['categoria'])) {
                $conditions[] = "categoria = :categoria";
                $params[':categoria'] = $_GET['categoria'];
            }
            
            if (!empty($_GET['preco_min'])) {
                $conditions[] = "valor >= :preco_min";
                $params[':preco_min'] = $_GET['preco_min'];
            }
            
            if (!empty($_GET['preco_max'])) {
                $conditions[] = "valor <= :preco_max";
                $params[':preco_max'] = $_GET['preco_max'];
            }
            
            // Se houver filtros, adiciona ao SQL
            if (!empty($conditions)) {
                $sql .= " WHERE " . implode(" AND ", $conditions);
            }
            
            // Prepara a consulta
            $stmt = $pdo->prepare($sql);
            
            // Vincula os parâmetros
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            
            // Executa a consulta
            $stmt->execute();
            
            // Exibe os produtos
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $img_src = "imagens_/" . htmlspecialchars($row['imagem']);
                    $produto_nome = htmlspecialchars($row['nome_produto']);
                    $produto_preco = number_format($row['valor'], 2, ',', '.');
                    $descricao = htmlspecialchars($row['descricao']);
            ?>
            <div class="product-card">
                <img src="<?php echo $img_src; ?>" alt="<?php echo $produto_nome; ?>" class="product-image">
                <div class="product-info">
                    <h4>
                        <?php echo $produto_nome; ?>
                    </h4>
                    <p class="product-description">
                        <?php echo $descricao; ?>
                    </p>
                    <div class="pricing">
                        <p class="price">R$
                            <?php echo $produto_preco; ?>
                        </p>
                    </div>
                    <form action="adicionar_carrinho.php" method="post">
                        <input type="hidden" name="id_produto" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="nome_produto" value="<?php echo $produto_nome; ?>">
                        <input type="hidden" name="valor" value="<?php echo $row['valor']; ?>">
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" name="quantidade" value="1" min="1" required>
                        <button type="submit" class="buy-button">Adicionar ao Carrinho</button>
                    </form>

                    <p class="shipping">Frete Grátis</p>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<p>Nenhum produto encontrado.</p>";
            }
            
            ?>
        </main>
    </div>

    <script src="scripts/produtos.js"></script>
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
    <button id="btnTopo" onclick="voltarAoTopo()">↑ Topo</button>
    <script src="scripts_/produtos.js"></script>
</body>

</html>