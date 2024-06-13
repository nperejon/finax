<!DOCTYPE html>

<html>
<head>
    <title>FINEX - Site de Educação Financeira</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="<?= REDIRECT_URL ?>/styles/moedas.css">
</head>

<body>
<a href="<?= REDIRECT_URL ?>" class="back"><i class="fas fa-arrow-left"></i> Voltar</a>
<div class="container" id="container">
    <h2>Cotação de Moedas Internacionais</h2>
    <div class="currencies"></div>
</div>
<script src="<?= REDIRECT_URL ?>/scripts/moedas.js"></script>
</body>
</html>