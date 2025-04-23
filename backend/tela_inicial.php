<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo ao AirPlace</title>
    <link rel="stylesheet" href="estilos_/style_home.css">
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
                <li><a href="sobrenos.php">Sobre nós</a></li>
                <li><a href="ofertas.php">Ofertas</a></li>
                <li><a href="produtos.php">Produtos</a></li>
                <li><a href="drones.php">Conheça nossos Drones</a></li>
                <li><a href="airplay.php">Air Play</a></li>
            </ul>
        </nav>
    </header>

    <div class="linha-laranja"></div>

    <div class="linha-laranja"></div>
    <section class="banner">
        <div class="banner-content">
            <img src="imagens_/drone_voador.png" alt="Drone Image">
            <div class="banner-text">
                <h1>AIR PLACE</h1>
                <p>Qualidade <br> e Velocidade</p>
            </div>

        </div>

    </section>
    <div class="faixa"></div>

    <main>
        <div class="carrossel">
            <div class="carrossel-container">
                <div class="carrossel-slide">
                    <img src="imagens_/celular_banner.jpg" Drone 1">
                </div>
                <div class="carrossel-slide">
                    <img src="imagens_/fone_banner.jpg" alt="Drone 2">
                </div>
            </div>
            <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
            <button class="next" onclick="moveSlide(1)">&#10095;</button>
        </div>
        <div class="produtos">
            <div class="big-card">
                <h1>OFERTAS DO DIA</h1>
                <div class="textos">
                    <div class="img-card">
                        <img src="imagens_/anuncio_galaxy.webp" alt="img celular">
                    </div>
                    <div class="texts">
                        <p> Smartphone Samsung Galaxy <br> S23 256GB Preto 5G 8GB RAM 6,1” <br> Câm Tripla + Selfie 12MP
                        </p>
                        <div class="text-card">
                            <h5>Vendido e entregue por </h5><a href=""> Air place</a>
                        </div>
                        <div class="preco-desconto">
                            <h6>R$ 6.499,00</h6>
                        </div>
                        <div class="preco">
                            <h5>R$ 2.799,00</h5>
                        </div>

                        <h6 class="desconto"> (10% de desconto) </h6>
                        <h6 class="parcelas">ou R$ 3.110,00 em 10x de R$ 311,00</h6>
                    </div>

                </div>
            </div>
            <div class="big-card">
                <h1>OFERTAS DO DIA</h1>
                <div class="textos">
                    <div class="img-card">
                        <img src="imagens_/anuncio_smartv.webp" alt="img celular">
                    </div>
                    <div class="texts">
                        <p> Smart Tv Led 32 Hd Samsung Ls32betblggxzd <br> 2 Hdmi 1 Usb Preto </p>
                        <div class="text-card">
                            <h5>Vendido e entregue por </h5><a href=""> Air place</a>
                        </div>
                        <div class="preco-desconto">
                            <h6>R$ 6.499,00</h6>
                        </div>
                        <div class="preco">
                            <h5>R$ 2.799,00</h5>
                        </div>

                        <h6 class="desconto"> (10% de desconto) </h6>
                        <h6 class="parcelas">ou R$ 3.110,00 em 10x de R$ 311,00</h6>
                    </div>

                </div>
            </div>
            <div class="big-card">
                <h1>OFERTAS DO DIA</h1>
                <div class="textos">
                    <div class="img-card">
                        <img src="imagens_/anuncio_carregador.webp" alt="img celular">
                    </div>
                    <div class="texts">
                        <p>Carregador Portátil/Power Bank Geonav <br> 14000mAh - PB14KAL</p>
                        <div class="text-card">
                            <h5>Vendido e entregue por </h5><a href=""> Air place</a>
                        </div>
                        <div class="preco-desconto">
                            <h6>R$ 6.499,00</h6>
                        </div>
                        <div class="preco">
                            <h5>R$ 2.799,00</h5>
                        </div>

                        <h6 class="desconto"> (10% de desconto) </h6>
                        <h6 class="parcelas">ou R$ 3.110,00 em 10x de R$ 311,00</h6>
                    </div>
                </div>
            </div>

        </div>
        <div class="linha-laranja"></div>
        <div class="como-funciona">
            <div class="drone-banner">
                <img src="imagens_/drone_preto.png" alt="">
            </div>
            <div class="text-drone">
                <h1>Como funcionam as entregas por Drones</h1>

                <p> Os drones de entrega funcionam de forma <br> semelhante a outros transportes, mas com <br> algumas
                    particularidades: </p>
                <p>Planejar a rota: Os drones são programados <br> para seguir uma rota predefinida,<br> considerando
                    obstáculos e destinos. </p>
                <p>Decolagem e pouso: O drone decola e segue a <br> rota planejada, usando sensores para se <br>
                    orientar. Ao chegar ao destino, o drone pode <br> pousar ou ficar parado no ar enquanto <br>
                    descarrega a mercadoria. </p>
                <p>Entrega: O pacote é entregue por meio de um <br>mecanismo de liberação. </p>
                <p>Retorno: O drone retorna para o centro de <br> distribuição ou local designado. </p>
                <p>Notificação: O destinatário é informado da <br> entrega concluída. </p>
            </div>
        </div>
        <HR>
        </HR>
        <div class="servicos">
            <h1>SERVIÇOS</h1>
        </div>
        <div class="carousel-container">

            <button class="carousel-btn prev" onclick="prevSlide()">&#10094;</button>
            <div class="carousel-wrapper">

                <div class="carousel">
                    <div class="carrossel-div">
                        <div class="carousel-item">
                            <img src="imagens_/imagem1.png" alt="Imagem 1">

                        </div>
                        <p>AIRPAY</p>
                    </div>
                    <div class="carrossel-div">
                        <div class="carousel-item">
                            <img src="imagens_/imagem2.png" alt="Imagem 2">

                        </div>
                        <p>AJUDA</p>
                    </div>
                    <div class="carrossel-div">
                        <div class="carousel-item">
                            <img src="imagens_/imagem3.png" alt="Imagem 3">

                        </div>
                        <p>LISTA <br> DE CASAMENTO</p>
                    </div>
                    <div class="carrossel-div">
                        <div class="carousel-item">
                            <img src="imagens_/imagem4.png" alt="Imagem 4">

                        </div>
                        <p>ACESSIBILIDADE</p>
                    </div>
                    <div class="carrossel-div">
                        <div class="carousel-item">
                            <img src="imagens_/imagem5.png" alt="Imagem 5">

                        </div>
                        <p>CONSULTE<br>SUA FATURA</p>
                    </div>
                </div>
            </div>
            <button class="carousel-btn next" onclick="nextSlide()">&#10095;</button>
        </div>

    </main>

    <script src="scripts/carrosel.js"></script>
</body>

</html>


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
        <p>CNPJ nº 00.000.000/0000-00 / Av. das Nações Unidas, nº 3.203, Bonfim, Osasco/SP - CEP 00000-000 - empresa do
            grupo AIR PLACE</p>
    </div>
</footer>
</body>

</html>