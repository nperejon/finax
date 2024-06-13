// Obtém o botão de imagem
const imagemBotao = document.getElementById('imagem-botao');

// Obtém as opções
const opcoes = document.getElementById('opcoes');

// Exibe/oculta as opções ao clicar no botão de imagem
imagemBotao.addEventListener('click', function() {
    opcoes.style.display = opcoes.style.display === 'block' ? 'none' : 'block';
});

// Ação ao clicar no botão "Perfil"
document.getElementById('perfil').addEventListener('click', function() {
    alert('Opção: Perfil');
});

// Ação ao clicar no botão "Sair"
document.getElementById('sair').addEventListener('click', function() {
    alert('Opção: Sair');
});
