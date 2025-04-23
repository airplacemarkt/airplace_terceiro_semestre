// Mostrar botão quando rolar para baixo
window.onscroll = function() {
    const botao = document.getElementById("btnTopo");
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        botao.style.display = "block";
    } else {
        botao.style.display = "none";
    }
};

// Rolar suavemente ao topo
function voltarAoTopo() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}