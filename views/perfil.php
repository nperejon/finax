<!DOCTYPE html>

<html>
<head>
    <title>FINEX - Site de Educação Financeira</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="<?= REDIRECT_URL ?>/styles/profile.css">
</head>

<body>
<a href="<?= REDIRECT_URL ?>" class="back"><i class="fas fa-arrow-left"></i> Voltar</a>
<div class="container" id="container">
    <h2>Perfil</h2>
    <div class="profile">
        <i class="fas fa-user"></i>
        <p><b>Nome:</b> <?= $username ?></p>
        <p><b>Email:</b> <?= $email ?></p>
        <p><b>Telefone:</b> <?= $phone ?></p>
        <p><b>Data de Nascimento:</b> <?= $birthdate ?></p>
    </div>
</div>
<script src="<?= REDIRECT_URL ?>/scripts/moedas.js"></script>
</body>
</html>