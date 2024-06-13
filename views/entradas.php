<!DOCTYPE html>

<html>
<head>
    <title>FINEX - Site de Educação Financeira</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="<?= REDIRECT_URL ?>/styles/entradas.css">
</head>

<body>
<a href="<?= REDIRECT_URL ?>" class="back"><i class="fas fa-arrow-left"></i> Voltar</a>
<div class="container" id="container">
    <div class="entries">
        <div class="form-container sign-in">
            <div class="entries-container">
                <h1>Registros de Entradas e Saídas</h1>
                <div class="registers">
                    <span class="entry active">Entradas</span>
                    <span class="exit">Saídas</span>
                </div>
            </div>

            <div class="entry-content">
                <span class="total">Total: R$ <?= number_format($total_inflow, 2, ',', '.') ?></span>
                <div class="entries-grid">
                    <?php foreach ($inflows as $inflow): ?>
                        <div class="entry">
                            <div class="icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="content">
                                <div class="content_text">
                                    <span class="entry_name"><?= $inflow->nome ?></span>
                                    <span class="entry_value">R$ <?= number_format($inflow->valor, 2, ',', '.') ?></span>
                                </div>
                                <div class="content_buttons">
                                    <a href="<?= REDIRECT_URL ?>/remover-entrada/<?= $inflow->id ?>" class="remove"><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <form method="POST" id="register-entry" class="register-entry">
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                    <input type="hidden" name="type" value="entry">
                    <input type="text" name="nome" placeholder="Nome da Entrada">
                    <input type="number" name="valor" placeholder="Valor da Entrada">
                    <button name="register-entry" id="register-entry-btn">Registrar Entrada</button>
                </form>
            </div>

            <div class="exit-content none">
                <span class="total">Total: R$ <?= number_format($total_outflow, 2, ',', '.') ?></span>
                <div class="entries-grid">
                    <?php foreach ($outflows as $outflow): ?>
                        <div class="entry">
                            <div class="icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="content">
                                <div class="content_text">
                                    <span class="entry_name"><?= $outflow->nome ?></span>
                                    <span class="entry_value">R$ <?= number_format($outflow->valor, 2, ',', '.') ?></span>
                                </div>
                                <div class="content_buttons">
                                    <a href="<?= REDIRECT_URL ?>/remover-saida/<?= $outflow->id ?>" class="remove"><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <form method="POST" id="register-exit" class="register-entry register-exit">
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                    <input type="hidden" name="type" value="exit">
                    <input type="text" name="nome" placeholder="Nome da Saída">
                    <input type="number" name="valor" placeholder="Valor da Saída">
                    <button name="register-exit" id="register-exit-btn">Registrar Saída</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= REDIRECT_URL ?>/scripts/entradas.js"></script>
</body>
</html>