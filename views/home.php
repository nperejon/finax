<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programa de Finanças</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap">
    <link rel="stylesheet" href="<?= REDIRECT_URL ?>/styles/home.css">
</head>

<body>
    <div class="container" id="container">
        <h1 class="titulo">Finax™</h1>
        <div class="menu">
            <a id="moedas" class="botao" href="<?= REDIRECT_URL ?>/moedas">Moedas</a>
            <a id="registros" class="botao" href="<?= REDIRECT_URL ?>/entradas">Registros</a>
        </div>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20962 10601">

            <path class="wave-2" fill="rgb(0, 75, 29)"
                d="M25681 10400c-171 822-305 1990-646 3115-341 1124-889 2206-1856 2808-968 602-2355 724-4668 1064s-5550 898-8520 987-5672-290-9037-859c-3366-568-7394-1326-9403-2118-2008-791-1996-1616-1892-3305 103-1689 298-4242 1412-5731 1113-1488 3146-1912 4953-1627 1808 284 3390 1276 4522 1878s1814 814 2423 552 1145-998 2333-1388c1187-389 3025-432 4266 275 1240 707 1884 2164 2861 2407 976 244 2285-726 3493-1308 1209-581 2316-775 3731-567 1415 207 3137 815 4290 1221 1153 407 1737 612 1926 953 189 342-18 820-188 1643z" />

            <path class="wave-3" fill="#50C878"
                d="M30706 11822c-291 731-653 1801-1548 2972-895 1170-2321 2441-4988 3026-2667 586-6574 485-10469 541s-7778 268-10906-256-5501-1784-6906-3382c-1404-1598-1840-3533-1957-4910-118-1377 82-2195 1029-2854 946-659 2637-1158 4033-1002s2495 968 3440 1630 1737 1175 2905 1086c1169-89 2714-780 3810-1332 1095-552 1740-965 2665-820s2130 848 3110 1360c980 513 1734 837 2458 672s1416-819 2179-1050 1597-40 3058 269c1461 310 3550 739 5069 1177 1519 437 2469 883 2998 1112 529 228 639 240 584 440-55 201-274 591-564 1321z" />
        </svg>
        <p class="mensagem-usuario">Olá, <?= $username ?>!</p>

        <button id="imagem-botao" class="botao-imagem"></button>
        <div id="opcoes" class="opcoes">
            <button id="perfil"><a href="<?= REDIRECT_URL ?>/profile">Perfil</a></button>
            <button id="sair"> <a href="<?= REDIRECT_URL ?>/logout">Sair</a></button>
        </div>
    </div>

    <script src="<?= REDIRECT_URL ?>/scripts/home.js"></script>
</body>

</html>