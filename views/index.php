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
    <div class="container 
    <?php 
        if (isset($_SESSION['message']) && isset($_SESSION['message']['mode']) && $_SESSION['message']['mode'] == 'register') {
            echo 'active';
        }
    ?>
    " id="container">
        <div class="form-container sign-in">
            <form method="POST" name="login">
                <?php 
                    if (isset($_SESSION['message']) && isset($_SESSION['message']['mode']) && $_SESSION['message']['mode'] == 'login') {
                        $message = $_SESSION['message'];
                        echo "<div class='message {$message['type']}'>{$message['message']}</div>";
                        unset($_SESSION['message']);
                    }
                ?>
                <h1>Entre com sua conta!</h1>
                <span>Ou insira seu e-mail e sua senha</span>
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <input type="email" name="email" class="login" placeholder="E-mail" required>
                <input type="password" name="senha" class="login" placeholder="Insira uma senha" required>
                <input type="submit" name="login" value="Entrar">
                <a href="senha.html" id="forgotpassword">Esqueceu sua senha?</a>
            </form>
        </div>
                

        <div class="form-container sign-up">
            <form method="POST" name="register">
                <?php 
                    if (isset($_SESSION['message']) && isset($_SESSION['message']['mode']) && $_SESSION['message']['mode'] == 'register') {
                        $message = $_SESSION['message'];
                        echo "<div class='message {$message['type']}'>{$message['message']}</div>";
                        unset($_SESSION['message']);
                    }
                ?>
                <h1>Crie sua conta!</h1>
                <span>Ou cadastre-se no nosso site</span>
                <input type="text" name="nome" class="registers" placeholder="Nome" required>
                <input type="email" name="email" class="registers" placeholder="E-mail" required>
                <input type="password" name="senha" class="registers" placeholder="Insira uma senha" required>
                <input type="telefone" name="telefone" class="registers" placeholder="Nº de celular">
                <input type="date" class="registers" name="datanascimento" placeholder="Data de nascimento" required>
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <input id="registrar" type="submit" name="register" value="Registrar">
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