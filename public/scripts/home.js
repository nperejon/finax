// Obtém o botão de imagem
const imagemBotao = document.getElementById('imagem-botao');

// Obtém as opções
const opcoes = document.getElementById('opcoes');

// Exibe/oculta as opções ao clicar no botão de imagem
imagemBotao.addEventListener('click', function() {
    opcoes.style.display = opcoes.style.display === 'block' ? 'none' : 'block';
});
