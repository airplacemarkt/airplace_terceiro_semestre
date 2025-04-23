document.addEventListener('DOMContentLoaded', function() {

    // Função para cancelar a compra e voltar para a página inicial
    const cancelarCompraBtn = document.getElementById('cancelar-compra');
    if (cancelarCompraBtn) {
        cancelarCompraBtn.addEventListener('click', function(event) {
            event.preventDefault();
            if (confirm("Tem certeza que deseja cancelar a compra?")) {
                window.location.href = "index.php"; // Ou para qualquer página inicial que você preferir
            }
        });
    }

    // Exibir loader e simular o processamento do pedido
    const finalizarCompraBtn = document.getElementById('finalizar-compra');
    const loader = document.getElementById('loader');
    const resultadoFinal = document.getElementById('resultado-final');

    if (finalizarCompraBtn) {
        finalizarCompraBtn.addEventListener('click', function(event) {
            event.preventDefault();
            loader.style.display = 'block'; // Exibe o loader enquanto processa o pedido
            setTimeout(function() {
                loader.style.display = 'none'; // Remove o loader após 3 segundos
                resultadoFinal.style.display = 'block'; // Exibe a mensagem de sucesso
            }, 3000); // Simulando o tempo de processamento de 3 segundos
        });
    }

});
