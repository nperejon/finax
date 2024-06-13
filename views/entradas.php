<!DOCTYPE html>

<html>
<head>
    <title>FINEX - Site de Educação Financeira</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="styles/entradas.css">
</head>

<body>
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
                <span class="total">Total: R$ 0,00</span>
                <div class="entries-grid">
                    <div class="entry">
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="content">
                            <div class="content_text">
                                <span class="entry_name">Conta Poupança</span>
                                <span class="entry_value">R$ 0,00</span>
                            </div>
                            <div class="content_buttons">
                                <button class="delete"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="entry">
                        <div class="icon">
                            <i class="fa-solid fa-money-bill"></i>
                        </div>
                        <div class="content">
                            <div class="content_text">
                                <span class="entry_name">Conta Corrente</span>
                                <span class="entry_value">R$ 0,00</span>
                            </div>
                            <div class="content_buttons">
                                <button class="delete"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="entry">
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="content">
                            <div class="content_text">
                                <span class="entry_name">Bolsa de Valores</span>
                                <span class="entry_value">R$ 0,00</span>
                            </div>
                            <div class="content_buttons">
                                <button class="delete"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="register-entry">
                    <input type="text" placeholder="Nome da Entrada">
                    <input type="number" placeholder="Valor da Entrada">
                    <button id="register-entry-btn">Registrar</button>
                </div>
            </div>

            <div class="exit-content none">
                <span class="total">Total: R$ 0,00</span>
                <div class="entries-grid">
                    
                    <div class="entry">
                        <div class="icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="content">
                            <div class="content_text">
                                <span class="entry_name">Restaurante</span>
                                <span class="entry_value">R$ 0,00</span>
                            </div>
                            <div class="content_buttons">
                                <button class="delete"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="entry">
                        <div class="icon">
                            <i class="fa-solid fa-money-bill"></i>
                        </div>
                        <div class="content">
                            <div class="content_text">
                                <span class="entry_name">Aluguel</span>
                                <span class="entry_value">R$ 0,00</span>
                            </div>
                            <div class="content_buttons">
                                <button class="delete"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="entry">
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="content">
                            <div class="content_text">
                                <span class="entry_name">Transporte</span>
                                <span class="entry_value">R$ 0,00</span>
                            </div>
                            <div class="content_buttons">
                                <button class="delete"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="register-entry register-exit">
                    <input type="text" placeholder="Nome da Saída">
                    <input type="number" placeholder="Valor da Saída">
                    <button id="register-exit-btn">Registrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./scripts/entradas.js"></script>
</body>
</html>