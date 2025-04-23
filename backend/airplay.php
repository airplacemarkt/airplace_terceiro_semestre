<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirPlay</title>
    <link rel="stylesheet" href="estilos_/style_play.css">
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
                <li><a href="ofertas.php">Ofertas</a></li>
                <li><a href="produtos.php">Produtos</a></li>
                <li><a href="drones.php">Conheça nossos Drones</a></li>
            </ul>
        </nav>
    </header>

    <div class="linha-laranja"></div>

    <!-- Container para o carrossel de vídeos -->
    <div class="container">
        <div class="carousel">
            <div class="carousel-inner">
                <div class="carousel-item">
                    <video controls>
                        <source src="imagens_/video_drone.mp4" type="video/mp4">
                        Seu navegador não suporta o formato de vídeo.
                    </video>
                    <div class="interaction">
                        <span class="like-button"><i class="fas fa-heart"></i> <span class="like-count"
                                style="margin-right: 5px;">0</span> Curtidas</span>
                        <span class="comment-button"><i class="fas fa-comment"></i> Comentários</span>
                    </div>
                    <div class="comments-section">
                        <ul class="comments-list"></ul>
                        <input type="text" class="comment-input" placeholder="Adicionar um comentário...">
                    </div>
                </div>
                <div class="carousel-item">
                    <video controls>
                        <source src="imagens_/video_entregadrone.mp4" type="video/mp4">
                        Seu navegador não suporta o formato de vídeo.
                    </video>
                    <div class="interaction">
                        <span class="like-button"><i class="fas fa-heart"></i> <span class="like-count"
                                style="margin-right: 5px;">0</span> Curtidas</span>
                        <span class="comment-button"><i class="fas fa-comment"></i> Comentários</span>
                    </div>
                    <div class="comments-section">
                        <ul class="comments-list"></ul>
                        <input type="text" class="comment-input" placeholder="Adicionar um comentário...">
                    </div>
                </div>
                <div class="carousel-item">
                    <video controls>
                        <source src="imagens_/video_droneentrega.mp4" type="video/mp4">
                        Seu navegador não suporta o formato de vídeo.
                    </video>
                    <div class="interaction">
                        <span class="like-button"><i class="fas fa-heart"></i> <span class="like-count"
                                style="margin-right: 5px;">0</span> Curtidas</span>
                        <span class="comment-button"><i class="fas fa-comment"></i> Comentários</span>
                    </div>
                    <div class="comments-section">
                        <ul class="comments-list"></ul>
                        <input type="text" class="comment-input" placeholder="Adicionar um comentário...">
                    </div>
                </div>
            </div>
            <div class="carousel-controls">
                <button class="carousel-button prev">&lt;</button>
                <button class="carousel-button next">&gt;</button>
            </div>
        </div>
    </div>

    <!-- Rodapé da página -->
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

    <script>
        // Seleciona os botões de navegação e o contêiner interno do carrossel
        const prevButton = document.querySelector('.prev');
        const nextButton = document.querySelector('.next');
        const carouselInner = document.querySelector('.carousel-inner');
        let currentIndex = 0; // Índice do item atual no carrossel

        // Função para atualizar a posição do carrossel
        function updateCarousel() {
            const itemWidth = carouselInner.querySelector('.carousel-item').clientWidth; // Largura de cada item
            carouselInner.style.transform = `translateX(-${currentIndex * itemWidth}px)`; // Move o carrossel
        }

        // Adiciona um evento de clique ao botão "prev"
        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--; // Move para o item anterior
            } else {
                currentIndex = carouselInner.querySelectorAll('.carousel-item').length - 1; // Vai para o último item
            }
            updateCarousel();
        });

        // Adiciona um evento de clique ao botão "next"
        nextButton.addEventListener('click', () => {
            if (currentIndex < carouselInner.querySelectorAll('.carousel-item').length - 1) {
                currentIndex++; // Move para o próximo item
            } else {
                currentIndex = 0; // Volta para o primeiro item
            }
            updateCarousel();
        });

        // Inicializa o carrossel quando a página carrega
        window.addEventListener('load', updateCarousel);

        document.querySelectorAll('.like-button').forEach((button, index) => {
            const likeCount = button.querySelector('.like-count');
            const savedLikes = localStorage.getItem(`likeCount_${index}`) || 0; // Obtém o número de curtidas salvo no localStorage
            const isLiked = localStorage.getItem(`liked_${index}`) === 'true'; // Obtém o estado de curtida salvo no localStorage

            // Inicializa o número de curtidas e o estado visual com base no localStorage
            likeCount.textContent = savedLikes;
            let liked = isLiked;

            if (liked) {
                button.classList.add('liked'); // Marca como curtido visualmente
            }

            // Função para curtir/descurtir o vídeo
            button.addEventListener('click', function () {
                let count = parseInt(likeCount.textContent);

                if (!liked) { // Se ainda não curtiu
                    count++;
                    button.classList.add('liked'); // Marca como curtido visualmente
                    liked = true; // Define como curtido
                } else { // Se já curtiu, permite "descurtir"
                    count--;
                    button.classList.remove('liked'); // Remove a classe de curtido
                    liked = false; // Define como não curtido
                }

                likeCount.textContent = count; // Atualiza o número de curtidas

                // Salva o número de curtidas e o estado de curtida no localStorage
                localStorage.setItem(`likeCount_${index}`, count);
                localStorage.setItem(`liked_${index}`, liked);
            });
        });


        // Função de comentários
        document.querySelectorAll('.comment-button').forEach(button => {
            button.addEventListener('click', function () {
                const commentsSection = this.closest('.carousel-item').querySelector('.comments-section');
                commentsSection.style.display = commentsSection.style.display === 'none' || !commentsSection.style.display ? 'block' : 'none';
            });
        });

        // Função para salvar comentários no localStorage
        function saveComments(commentsArray, key) {
            localStorage.setItem(key, JSON.stringify(commentsArray));
        }

        // Função para carregar comentários do localStorage
        function loadComments(key) {
            const storedComments = localStorage.getItem(key);
            return storedComments ? JSON.parse(storedComments) : [];
        }

        // Função para renderizar os comentários salvos
        function renderComments(commentList, commentsArray) {
            commentList.innerHTML = ''; // Limpa os comentários antes de renderizar
            commentsArray.forEach((comment, index) => {
                const newComment = document.createElement('li');
                newComment.textContent = comment;

                // Adiciona o ícone de excluir comentário (lixeira)
                const deleteIcon = document.createElement('i');
                deleteIcon.classList.add('fas', 'fa-trash', 'delete-icon');
                deleteIcon.style.cursor = 'pointer'; // Cursor de ponteiro para indicar que é clicável
                deleteIcon.addEventListener('click', function () {
                    commentsArray.splice(index, 1); // Remove o comentário do array
                    saveComments(commentsArray, commentList.dataset.key); // Atualiza o localStorage
                    renderComments(commentList, commentsArray); // Re-renderiza os comentários
                });

                // Adiciona o ícone ao comentário
                newComment.appendChild(deleteIcon);
                commentList.appendChild(newComment); // Adiciona o comentário à lista
            });
        }

        // Adicionar comentário
        document.querySelectorAll('.comment-input').forEach((input, index) => {
            const commentList = input.closest('.comments-section').querySelector('.comments-list');
            const storageKey = `comments_section_${index}`; // Define uma chave única para cada seção de comentários
            commentList.dataset.key = storageKey;

            // Carrega e renderiza os comentários salvos no localStorage
            let commentsArray = loadComments(storageKey);
            renderComments(commentList, commentsArray);

            // Adiciona novo comentário ao pressionar "Enter"
            input.addEventListener('keypress', function (e) {
                if (e.key === 'Enter' && this.value.trim() !== '') {
                    commentsArray.push(this.value.trim()); // Adiciona o comentário ao array
                    saveComments(commentsArray, storageKey); // Salva o comentário no localStorage
                    renderComments(commentList, commentsArray); // Renderiza os comentários
                    this.value = ''; // Limpa o input
                }
            });
        });


    </script>
</body>

</html>