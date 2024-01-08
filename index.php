<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('config/config.php');

$session_expiration = 1800;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_expiration)) {
    session_unset();
    session_destroy();
    exit();
}

$_SESSION['last_activity'] = time();

?>

<!doctype html>
<html lang="pt-BR" data-bs-theme="auto">

<head>
    <!-- JAVASCRIPT RESPONSÁVEL PELO BOTÃO QUE TROCA OS TEMAS -->
    <script src="assets/js/themes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/img/logo.png" type="image/png">
    <title>CO2 Peças</title>
    <meta name="description" content="Descubra a excelência em peças de linha pesada na nossa loja especializada. Encontre uma vasta seleção de componentes de alta qualidade para veículos comerciais e industriais. Combinamos expertise e variedade para atender às suas necessidades, oferecendo soluções duráveis e confiáveis. Explore nosso catálogo abrangente e garanta o desempenho ideal para sua frota. Seja para caminhões, ônibus ou maquinário pesado, nossa loja é o destino definitivo para quem busca peças que fazem a diferença. Qualidade superior e atendimento excepcional - sua jornada rumo à eficiência com seu veículo pesado começa aqui.">
    <meta name="keywords" content="peças de caminhão, caminhão, autopeças, reposição, manutenção, mecânica, motor, freios, suspensão, transmissão, embreagem, direção, elétrica, pneus, acessórios, segurança, Mercedes-Benz, Volkswagen, Scania, Volvo, Iveco, Ford, Chevrolet, Actros, Constellation, P-Series, FH, Daily, F-Series, Silverado, filtro de óleo, bomba de água, junta de cabeçote, biela, pistão, eixo, rolamento, mola, cabo de embreagem, mangueira de radiador, pneu para caminhão, acessorios para caminhão, equipamentos de segurança para caminhão">
    <meta name="author" content="CO2 Peças, Pablo Nogueira de Faria">
    <!-- Estilos do index -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="ext/bootstrap/bootstrap.min.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="ext/owlcarousel/owl.carousel.min.css">

</head>

<body>
    <!-- MARCAÇÕES RESPONSÁVEIS PELO BOTÃO QUE TROCA O TEMA E BOTÃO WHATSAPP ------ INÍCIO -->

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
        </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 me-3 bd-mode-toggle">
        <button title="Botão para trocar temas" class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                <use href="#circle-half"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Troca de Temas</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button title="Trocando para modo diurno" type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#sun-fill"></use>
                    </svg>
                    Diurno
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button title="Trocando para modo noturno" type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    Noturno
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button title="Deixando em modo automático" type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#circle-half"></use>
                    </svg>
                    Automático
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
        </ul>
    </div>

    <div class="position-fixed bottom-0 end-0 me-3 whatsapp-link">
        <a href="https://api.whatsapp.com/send?phone=5562999999999" target="_blank" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.6em" height="1.6em" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
            </svg>
        </a>
    </div>

    <!-- MARCAÇÕES RESPONSÁVEIS PELO BOTÃO QUE TROCA O TEMA E BOTÃO WHATSAPP ------ FIM -->

    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg bg-body-tertiary p-2">
            <div class="container-fluid">
                <a title="Voltar à página principal" class="navbar-brand" href="#">
                    <img src="assets/img/logo.svg" alt="Logo" width="40" height="40" class="d-inline-block">
                    <strong><em>CO2 Peças</em></strong>
                </a>
                <button title="Botão aparente apenas em dispositivos móveis para retrair a barra de navegação." class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-small">
                        <li class="nav-item">
                            <a title="Navegar pela seção dos produtos" class="nav-link " href="#"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
                                    <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5m0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8zm.344 7.646.087.065z" />
                                </svg> Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a title="Visualizar itens no carrinho" class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                                </svg>
                                <span class="badge rounded-pill bg-danger">
                                    99+
                                    <span class="visually-hidden">Quantidade de produtos</span>
                                </span>
                            </a>
                        </li>

                        <?php
                        if (isset($_SESSION['id']) && isset($_SESSION['user_type'])) {
                        ?>
                            <li class="nav-item dropdown">
                                <a title="Opções do usuário em sua conta" href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php
                                    if ($_SESSION['user_type'] == 'admin' || $_SESSION['user_type'] == 'employee') {
                                    ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-incognito" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="m4.736 1.968-.892 3.269-.014.058C2.113 5.568 1 6.006 1 6.5 1 7.328 4.134 8 8 8s7-.672 7-1.5c0-.494-1.113-.932-2.83-1.205a1.032 1.032 0 0 0-.014-.058l-.892-3.27c-.146-.533-.698-.849-1.239-.734C9.411 1.363 8.62 1.5 8 1.5c-.62 0-1.411-.136-2.025-.267-.541-.115-1.093.2-1.239.735m.015 3.867a.25.25 0 0 1 .274-.224c.9.092 1.91.143 2.975.143a29.58 29.58 0 0 0 2.975-.143.25.25 0 0 1 .05.498c-.918.093-1.944.145-3.025.145s-2.107-.052-3.025-.145a.25.25 0 0 1-.224-.274M3.5 10h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5m-1.5.5c0-.175.03-.344.085-.5H2a.5.5 0 0 1 0-1h3.5a1.5 1.5 0 0 1 1.488 1.312 3.5 3.5 0 0 1 2.024 0A1.5 1.5 0 0 1 10.5 9H14a.5.5 0 0 1 0 1h-.085c.055.156.085.325.085.5v1a2.5 2.5 0 0 1-5 0v-.14l-.21-.07a2.5 2.5 0 0 0-1.58 0l-.21.07v.14a2.5 2.5 0 0 1-5 0v-1Zm8.5-.5h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5" />
                                        </svg>
                                    <?php
                                    } else {
                                    ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                        </svg>
                                    <?php
                                    }
                                    ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    if ($_SESSION['user_type'] == 'admin' || $_SESSION['user_type'] == 'employee') {
                                    ?>
                                        <li>
                                            <a title="Visualizar os dados do usuário" class="dropdown-item" href="system/"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                                                    <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72l-.25-1Z" />
                                                </svg> Sistema
                                            </a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li>
                                            <a title="Visualizar os dados do usuário" class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-card-heading" viewBox="0 0 16 16">
                                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                                    <path d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0-5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z" />
                                                </svg> Meus
                                                dados
                                            </a>
                                        </li>
                                        <li>
                                            <a title="Visualizar os pedidos do usuário" class="dropdown-item" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                                </svg> Meus
                                                pedidos
                                            </a>
                                        </li>
                                    <?php
                                    }
                                    ?>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a title="Sair da conta" class="dropdown-item" href="controllers/access/logoutController.php">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                                            </svg> Sair
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        } else {

                        ?>
                            <li class="nav-item">
                                <a title="Realizar login ou criar conta" href="access.php" class="nav-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                                        <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1" />
                                        <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z" />
                                    </svg> Acesso
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <form id="searcher" class="col-md-3 col-10 mx-auto" role="search">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Insira descrição ou código da peça" aria-label="Search">
                        <button title="Botão para confirmar busca inserida" type="submit" class="btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </nav>
    </header>

    <main>
        <!--CAROUSEL SLIDES-->
        <section>
            <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active c-item">
                        <img src="assets/img/carousel/carousel-img-00.svg" class="d-block w-100 c-img" alt="Slide 1">
                        <div class="carousel-caption top-0 mt-4">
                            <p class="mt-5 fs-3 fw-bold text-uppercase text-white text-shadow-main"><em>As Principais
                                    Montadoras</em>
                            </p>
                            <h1 class="display-1 fw-bolder text-capitalize text-white text-shadow-main">Aqui Você
                                Encontrará
                                Compatibilidade</h1>
                        </div>
                    </div>
                    <div class="carousel-item c-item">
                        <img src="assets/img/carousel/carousel-img-01.svg" class="d-block w-100 c-img" alt="Slide 2">
                        <div class="carousel-caption top-0 mt-4">
                            <p class="text-uppercase fw-bold fs-3 mt-5 text-white text-shadow-main"><em>Diversas
                                    Marcas</em></p>
                            <p class="display-1 fw-bolder text-capitalize text-white text-shadow-main">Muitas opções pra
                                escolher</p>
                        </div>
                    </div>
                    <div class="carousel-item c-item">
                        <img src="assets/img/carousel/carousel-img-02.svg" class="d-block w-100 c-img" alt="Slide 3">
                        <div class="carousel-caption top-0 mt-4">
                            <p class="text-uppercase fw-bold fs-3 mt-5 text-white text-shadow-main"><em>Vendemos
                                    Qualquer Peça Que
                                    Precisar</em></p>
                            <p class="display-1 fw-bolder text-capitalize text-white text-shadow-main">Em Disposição
                                Todas As
                                Categorias</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Retornar</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Prosseguir</span>
                </button>
            </div>
        </section>

        <div class="divider"></div>

        <!--CAROUSEL PRODUTOS-->
        <section class="mt-3">
            <div class="mb-3">
                <h3 class="text-uppercase fw-bold text-center">Produtos que podem te interessar</h3>
            </div>
            <div class="container">
                <div class="owl-carousel owl-theme text-center">
                    <!-- PRODUTO EM CONDIÇÃO NORMAL - início -->
                    <div class="d-inline-block mx-auto">
                        <div class="card" style="width: 15rem; position: relative;">
                            <img src="assets/img/products/default-image.png" class="card-img-top rounded" alt="Imagem do produto">
                            <div class="card-title text-end me-2">
                                <span class="badge text-bg-success mt-3" style="font-size: 15px;">R$ 67,89</span>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title overflow-tooltip" title="FILTRO DE AR PRIMÁRIO" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    FILTRO DE AR PRIMÁRIO</h6>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    MARCA:<br><strong><em>Tecfil</em></strong></li>
                                <li class="list-group-item overflow-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="ASR8976 0036958781" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    CÓDIGO(S):<br><strong>ASR8976 0036958781</strong></li>
                            </ul>
                            <div class="position-absolute bottom-50 start-50 translate-middle-x">
                                <a title="Visualizar detalhes do produto" href="#" class="btn btn-primary shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </a>
                                <a title="Adicionar produto ao carrinho" href="#" class="btn btn-primary shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                        <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- PRODUTO EM CONDIÇÃO NORMAL - fim -->

                    <!-- PRODUTO EM CONDIÇÃO PROMOCIONAL - início -->
                    <div class="d-inline-block mx-auto">
                        <div class="card" style="width: 15rem; position: relative;">
                            <span class="ms-2 mt-1 badge fw-bolder text-bg-danger position-absolute">PROMOÇÃO
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                                    <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15" />
                                </svg>
                            </span>
                            <img src="assets/img/products/default-image.png" class="card-img-top rounded" alt="Imagem do produto">
                            <div class="row">
                                <div class="card-title text-center">
                                    <span class="badge text-bg-secondary mt-3 text-decoration-line-through" style="font-size: 13px;">R$ 113,89</span>
                                    <span class="badge text-bg-success mt-3" style="font-size: 15px;">R$ 67,89</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title overflow-tooltip" title="FILTRO DE AR PRIMÁRIO" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    FILTRO DE AR PRIMÁRIO</h6>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    MARCA:<br><strong><em>Tecfil</em></strong></li>
                                <li class="list-group-item overflow-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="ASR8976 0036958781" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    CÓDIGO(S):<br><strong>ASR8976 0036958781</strong></li>
                            </ul>
                            <div class="position-absolute bottom-50 start-50 translate-middle-x">
                                <a title="Visualizar detalhes do produto" href="#" class="btn btn-primary shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </a>
                                <a title="Adicionar produto ao carrinho" href="#" class="btn btn-primary shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                        <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- PRODUTO EM CONDIÇÃO PROMOCIONAL - fim -->
                </div>
            </div>
        </section>

        <div class="divider"></div>

        <!--LISTANDO AS QUALIDADES ATRAVÉS DE UM FEATURE-->
        <section class="container mt-3">
            <h2 class="pb-2 border-bottom">Várias vantagens para você
                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-emoji-laughing" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path d="M12.331 9.5a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5M7 6.5c0 .828-.448 0-1 0s-1 .828-1 0S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 0-1 0s-1 .828-1 0S9.448 5 10 5s1 .672 1 1.5" />
                </svg>
            </h2>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
                <div class="col d-flex align-items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.75em" height="1.75em" fill="currentColor" class="bi bi-truck text-body-secondary flex-shrink-0 me-3" viewBox="0 0 16 16">
                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                    </svg>
                    <div>
                        <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Frete do seu jeito</h3>
                        <p>Não importando qual transportadora você prefira, iremos enviar seus produtos como desejar
                            após a compra.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.75em" height="1.75em" fill="currentColor" class="bi bi-headset text-body-secondary flex-shrink-0 me-3" viewBox="0 0 16 16">
                        <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5" />
                    </svg>
                    <div>
                        <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Atendimento Excepcional ao Cliente</h3>
                        <p>Nossa equipe está pronta para fornecer suporte e orientação, assegurando que você tenha a
                            melhor experiência ao escolher suas peças conosco.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.75em" height="1.75em" fill="currentColor" class="bi bi-building text-body-secondary flex-shrink-0 me-3" viewBox="0 0 16 16">
                        <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                        <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z" />
                    </svg>
                    <div>
                        <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Benefícios adicionais para CNPJ</h3>
                        <p>Para clientes com CNPJ oferecemos facilidade no processo de faturamento para a empresa,
                            descontos exclusivos em compras de grande volume e auxílio em demandas corporativas.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.75em" height="1.75em" fill="currentColor" class="bi bi-award text-body-secondary flex-shrink-0 me-3" viewBox="0 0 16 16">
                        <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702z" />
                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z" />
                    </svg>
                    <div>
                        <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Garantia de Qualidade</h3>
                        <p>Nossas peças, novas e seminovas, são submetidas a padrões de qualidade, além de possuir
                            garantia. Queremos que você compre solução ao adquirir nossos produtos!</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="divider"></div>

        <!--BANNER E HERO-->
        <section class="mt-3">
            <div class="container col-xxl-8 px-4 py-5">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="assets/img/banner.svg" class="d-block mx-lg-auto img-fluid rounded" alt="Mensagem ilustrativa" width="700" height="500">
                    </div>
                    <div class="col-lg-6">
                        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Não encontrou a peça que precisa em
                            nosso site? Sem problemas!</h1>
                        <p class="lead">Temos em nossa disposição diversos fornecedores! Solicite uma cotação informando
                            o chassi do seu veículo e a(s) peça(s) que deseja. Rapidamente iremos lhe responder!</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <a title="Ir para página de contatos solicitar cotação personalizada" href="" class="btn btn-primary btn-lg px-4 me-md-2">Realizar cotação</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="divider"></div>
    </main>

    <footer class="py-3 my-4">
        <ul class="nav justify-content-center pt-2 pb-3 mb-3">
            <li class="nav-item"><a href="policies.php" class="nav-link px-2 link-body-emphasis text-primary">Políticas</a>
            </li>
            <li class="nav-item"><a href="terms.html" class="nav-link px-2 link-body-emphasis text-primary">Termos
                    de
                    uso</a></li>
            <li class="nav-item"><a href="contacts.html" class="nav-link px-2 link-body-emphasis text-primary">Contatos</a>
            </li>
            <li class="nav-item"><a href="about-us.html" class="nav-link px-2 link-body-emphasis text-primary">Sobre
                    nós</a>
            </li>
        </ul>
        <div class="d-flex justify-content-center text-center flex-column flex-md-row align-items-center">
            <div class="col-md-5 mb-4">
                <img class="img-fluid" src="assets/img/certificado-SSL.svg" width="50%" alt="Logo">
            </div>
            <div class="col-md-5 mb-4">
                <img class="img-fluid" src="assets/img/payment-methods.svg" width="60%" alt="Logo">
            </div>
        </div>
        <p class="text-center text-body-secondary"><img src="assets/img/logo.svg" width="100" height="100" alt="Logo">
        </p>
        <p class="text-center text-body-secondary">CO2 PEÇAS, COMÉRCIO E REPRESENTAÇÕES LTDA.</p>
        <p class="text-center text-body-secondary">CNPJ: 42.560.905/0001-66</p>
        <p id="direitos-autorais" class="text-center text-body-secondary"></p>
    </footer>

    <script src="ext/jquery/jquery-3.7.1.js"></script>
    <!--SCRIPTS OWL CAROUSEL INÍCIO-->
    <script src="ext/owlcarousel/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel();
        });

        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: false,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: false,
                    loop: true
                }
            }
        })
    </script>
    <!--SCRIPTS OWL CAROUSEL FIM-->

    <script type="text/javascript">
        var direitosAutorais = document.getElementById('direitos-autorais');
        var anoAtual = new Date().getFullYear();
        direitosAutorais.innerHTML = '&copy; ' + anoAtual + '. Todos os direitos reservados';
    </script>
    <script src="ext/bootstrap/bootstrap.bundle.min.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('.overflow-tooltip'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>