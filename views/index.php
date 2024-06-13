<!DOCTYPE html>
<html>
<head>
    <title>FINEX - Site de Educação Financeira</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="<?= REDIRECT_URL ?>/styles/index.css">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form>
                <h1>Entre com sua conta!</h1>
                <span>Ou insira seu e-mail e sua senha</span>
                <input type="email" class="login" placeholder="E-mail" required>
                <input type="password" class="login" placeholder="Insira uma senha" required>
                <button id="entrar">Entrar</button>

                <a href="senha.html" id="forgotpassword">Esqueceu sua senha?</a>
            </form>
        </div>
                

        <div class="form-container sign-up">
            <form>
                <h1>Crie sua conta!</h1>
                <span>Ou cadastre-se no nosso site</span>
                <input type="text" class="registers" placeholder="Nome" required>
                <input type="email" class="registers" placeholder="E-mail" required>
                <input type="password" class="registers" placeholder="Insira uma senha" required>
                <input type="telefone" class="registers" placeholder="Nº de celular">
                <button id="registrar">Registrar</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <img width="175px" height="175px" src="<?= REDIRECT_URL ?>/assets/question.svg">
                    <h1>Já possui conta?</h1>
                    <p>Insira seus dados para acessar nosso site!</p>
                    <button class="hidden" id="login">Entre com sua conta!</button>
                </div>
    
                <div class="toggle-panel toggle-right">
                    <img width="200px" height="200px" src="<?= REDIRECT_URL ?>/assets/welcome.svg">
                    <h1>Bem vindo(a) à FINEX™!</h1>
                    <p>Faça seu cadastro para ter acesso total aos recursos do site.</p>
                    <button class="hidden" id="register">Crie sua conta!</button>
                </div>
    
            </div>
        </div>
    </div>

    <script src="<?= REDIRECT_URL ?>/scripts/index.js"></script>
</body>

</html>