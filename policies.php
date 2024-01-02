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
    <meta name="description"
        content="Descubra a excelência em peças de linha pesada na nossa loja especializada. Encontre uma vasta seleção de componentes de alta qualidade para veículos comerciais e industriais. Combinamos expertise e variedade para atender às suas necessidades, oferecendo soluções duráveis e confiáveis. Explore nosso catálogo abrangente e garanta o desempenho ideal para sua frota. Seja para caminhões, ônibus ou maquinário pesado, nossa loja é o destino definitivo para quem busca peças que fazem a diferença. Qualidade superior e atendimento excepcional - sua jornada rumo à eficiência com seu veículo pesado começa aqui.">
    <meta name="keywords"
        content="peças de caminhão, caminhão, autopeças, reposição, manutenção, mecânica, motor, freios, suspensão, transmissão, embreagem, direção, elétrica, pneus, acessórios, segurança, Mercedes-Benz, Volkswagen, Scania, Volvo, Iveco, Ford, Chevrolet, Actros, Constellation, P-Series, FH, Daily, F-Series, Silverado, filtro de óleo, bomba de água, junta de cabeçote, biela, pistão, eixo, rolamento, mola, cabo de embreagem, mangueira de radiador, pneu para caminhão, acessorios para caminhão, equipamentos de segurança para caminhão">
    <meta name="author" content="CO2 Peças, Pablo Nogueira de Faria">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="ext/bootstrap/bootstrap.min.css">
</head>

<body>
    <!-- MARCAÇÕES RESPONSÁVEIS PELO BOTÃO QUE TROCA O TEMA E BOTÃO WHATSAPP ------ INÍCIO -->

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
            <path
                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path
                d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
            <path
                d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path
                d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
        </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 me-3 bd-mode-toggle">
        <button title="Botão para trocar temas"
            class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button"
            aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                <use href="#circle-half"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Troca de Temas</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button title="Trocando para modo diurno" type="button" class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="light" aria-pressed="false">
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
                <button title="Trocando para modo noturno" type="button" class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="dark" aria-pressed="false">
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
                <button title="Deixando em modo automático" type="button"
                    class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto"
                    aria-pressed="true">
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
            <svg xmlns="http://www.w3.org/2000/svg" width="1.6em" height="1.6em" fill="currentColor"
                class="bi bi-whatsapp" viewBox="0 0 16 16">
                <path
                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
            </svg>
        </a>
    </div>

    <!-- MARCAÇÕES RESPONSÁVEIS PELO BOTÃO QUE TROCA O TEMA E BOTÃO WHATSAPP ------ FIM -->

    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg bg-body-tertiary p-2">
            <div class="container-fluid">
                <a title="Voltar à página principal" class="navbar-brand" href="index.php">
                    <img src="assets/img/logo.svg" alt="Logo" width="40" height="40" class="d-inline-block">
                    <strong><em>CO2 Peças</em></strong>
                </a>
                <button title="Botão aparente apenas em dispositivos móveis para retrair a barra de navegação."
                    class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-small">
                        <li class="nav-item">
                            <a title="Navegar pela seção dos produtos" class="nav-link " href="#"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
                                    <path
                                        d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5m0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8zm.344 7.646.087.065z" />
                                </svg> Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a title="Visualizar itens no carrinho" class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-cart2" viewBox="0 0 16 16">
                                    <path
                                        d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                                </svg>
                                <span class="badge rounded-pill bg-danger">
                                    99+
                                    <span class="visually-hidden">Quantidade de produtos</span>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a title="Realizar login ou criar conta" href="access.php" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-door-open" viewBox="0 0 16 16">
                                    <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1" />
                                    <path
                                        d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z" />
                                </svg> Acesso
                            </a>
                        </li>
                        <!--
                        <li class="nav-item dropdown">
                            <a title="Opções do usuário em sua conta" href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path fill-rule="evenodd"
                                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a title="Visualizar os dados do usuário" class="dropdown-item" href="#"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            fill="currentColor" class="bi bi-card-heading" viewBox="0 0 16 16">
                                            <path
                                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                            <path
                                                d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0-5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z" />
                                        </svg> Meus
                                        dados
                                    </a>
                                </li>
                                <li>
                                    <a title="Visualizar os pedidos do usuário" class="dropdown-item" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                        </svg> Meus
                                        pedidos
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a title="Sair da conta" class="dropdown-item" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            fill="currentColor" class="bi bi-door-closed" viewBox="0 0 16 16">
                                            <path
                                                d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3zm1 13h8V2H4z" />
                                            <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0" />
                                        </svg> Sair
                                    </a>
                                </li>
                            </ul>
                        </li>
                    -->
                    </ul>
                </div>
            </div>
        </nav>
        <nav id="navbar-example2" class="navbar bg-body-tertiary px-3 mb-3">
            <a class="navbar-brand" href="#">Políticas da CO2 Peças</a>
            <ul class="nav nav-pills">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Privacidade</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#scrollspyHeading1-1">Compromisso da CO2 Peças</a></li>
                        <li><a class="dropdown-item" href="#scrollspyHeading1-2">Compromisso do Usuário</a></li>
                        <li><a class="dropdown-item" href="#scrollspyHeading1-3">Considerações</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#scrollspyHeading2">Entrega</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Devoluções e Afins</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#scrollspyHeading3-1">Sobre Trocas</a></li>
                        <li><a class="dropdown-item" href="#scrollspyHeading3-2">Sobre Devoluções</a></li>
                        <li><a class="dropdown-item" href="#scrollspyHeading3-3">Como Devolver os Produtos</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#scrollspyHeading4">Cookies</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
       
        <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%"
            data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
            <h4>Políticas de Privacidade</h4>
            <h6 id="scrollspyHeading1-1">Compromisso da CO2 Peças</h6>
            <p>
                A sua privacidade é importante para nós. É política da <a target="_blank" href="index.php"><em>CO2
                        Peças</em></a> a sua
                privacidade em relação a qualquer informação sua que possamos coletar no site <a target="_blank"
                    href="index.php"><em>CO2 Peças</em></a>,
                e outros sites que possuímos e operamos.
            </p>
            <p>
                Solicitamos informações pessoais apenas quando realmente precisamos delas para lhe fornecer um serviço.
                Fazemos por meios justos e legais, com o seu conhecimento e consentimento. Também informamos por que
                estamos coletando e como será usado.
            </p>
            <p>
                Apenas retemos as informações coletadas pelo tempo necessário para fornecer o serviço solicitado. Quando
                armazenamos dados, protegemos dentro de meios comercialmente aceitáveis para evitar perdas e roubos, bem
                como acesso, divulgação, cópia, uso ou modificação não autorizados.
            </p>
            <p>
                Não compartilhamos informações de identificação pessoal publicamente ou com terceiros, exceto quando
                exigido por lei.
            </p>
            <p>
                O nosso site pode ter links para sites externos que não são operados por nós. Esteja ciente de que não
                temos controle sobre o conteúdo e práticas desses sites e não podemos aceitar responsabilidade por suas
                respectivas políticas de privacidade.
            </p>
            <p>
                Você é livre para recusar a nossa solicitação de informações pessoais, entendendo que talvez não
                possamos
                fornecer alguns dos serviços desejados.
            </p>
            <p>
                O uso continuado de nosso site será considerado como aceitação de nossas práticas em torno de
                privacidade
                e informações pessoais. Se você tiver alguma dúvida sobre como lidamos com dados do usuário e
                informações
                pessoais, entre em contato conosco.
            </p>
            <h6 id="scrollspyHeading1-2">Compromisso do Usuário</h6>
            <p>
                O usuário se compromete a fazer uso adequado dos conteúdos e da informação que a CO2 - Peças e
                Representação oferece no site e com caráter enunciativo, mas não limitativo:<br>
                <br>
                &bull;Não se envolver em atividades que sejam ilegais ou contrárias à boa fé a à ordem pública;<br>
                &bull;Não difundir propaganda ou conteúdo de natureza racista, xenofóbica, jogos de azar,
                qualquer
                tipo de pornografia ilegal, de apologia ao terrorismo ou contra os direitos humanos;<br>
                &bull;Não causar danos aos sistemas físicos (hardwares) e lógicos (softwares) da <a target="_blank"
                    href="index.php"><em>CO2 Peças</em></a>,
                de seus fornecedores ou terceiros, para introduzir ou disseminar vírus informáticos ou quaisquer outros
                sistemas de hardware ou software que sejam capazes de causar danos anteriormente mencionados.<br>
            </p>
            <h6 id="scrollspyHeading1-3">Considerações</h6>
            <p>
                Esperemos que esteja esclarecido e, como mencionado anteriormente, se houver algo que você não tem
                certeza
                se precisa ou não, geralmente é mais seguro deixar os cookies ativados, caso interaja com um dos
                recursos
                que você usa em nosso site.
            </p>
            <h4 id="scrollspyHeading2">Políticas de Entrega</h4>
            <p>
                Ao cliente realizar uma compra via site da <a target="_blank" href="index.php"><em>CO2 Peças</em></a>, o
                pedido entrará em fase de preparação. A fase de preparação tem no máximo o prazo de <strong>2 dias
                    úteis</strong>.
            </p>
            <p>
                Concluída a fase de preparação do pedido, é feito imediatamente o despacho do pedido para a
                transportadora. O prazo de chegada do pedido até o destinatário é relativo e depende majoritariamente da
                distância que irá percorrer.
            </p>
            <p>
                A <a target="_blank" href="index.php"><em>CO2 Peças</em></a> se compromete em embalar bem o pedido
                (protegido de exposição)
                solicitado para o transporte, porém não se responsabiliza se a transportadora não prestou devidos
                cuidados
                com o pedido e deixou com que acontecesse avaria(s) com a condição do produto
                durante o processo até o destinatário.
            </p>
            <p>
                A <a target="_blank" href="index.php"><em>CO2 Peças</em></a> não se responsabiliza se o pedido
                desapareceu
                após ser entregue para a transportadora.
            </p>
            <p>
                É subentendido então que a modalidade de frete oferecida pela <a target="_blank"
                    href="index.php"><em>CO2
                        Peças</em></a> é chamada de FOB (<em>Free On Board</em>). Tal escolha se dá principalmente para
                oferecer ao
                comprador/cliente a oportunidade de escolher uma opção de frete que se adeque melhor às suas
                necessidades
                e prazos. Caso o cliente/comprador esteja com dificuldades em decidir a transportadora, a <a
                    target="_blank" href="index.php"><em>CO2
                        Peças</em></a> irá oferecer a melhor opção de transportadora levando em consideração o
                equilíbrio
                entre prazo e
                custo, beneficiando o máximo possível o comprador/cliente nesses dois parâmetros.
            </p>
            <p>
                É entendido que quando o usuário estiver fazendo uso deste site para realizar compra com a <a
                    target="_blank" href="index.php"><em>CO2 Peças</em></a>, toda esta página virtual chamada
                <em>Políticas
                    de
                    Entrega</em> está compreendida e aceita.
            <h4>Políticas de Devoluções e Afins</h4>
            <h6 id="scrollspyHeading3-1">Sobre Trocas</h6>
            <p>
                Condições para efetuar uma troca:<br>
                Caso queira efetuar uma troca, o produto deverá estar em perfeito estado e sem sinais de uso, ou seja,
                nas
                mesmas condições que você o recebeu. Além disso, é indispensável que o item esteja em sua embalagem
                original.
            </p>
            <p>
                Como solicitar uma troca:<br>
                Envie um e-mail para <span class="link-hover">loja@co2pecas.com.br</span> ou <span
                    class="link-hover">co2pecas.repcom@gmail.com</span>,
                informando seu nome completo, número do pedido e motivo da
                troca. O mesmo procedimento também pode ser feito via WhatsApp. Em seguida você receberá o nosso contato
                com as informações necessárias para efetuar a troca.
            </p>
            <h6 id="scrollspyHeading3-2">Sobre Devoluções</h6>
            <p>
                Condições para devolução por arrependimento:<br>
                Caso você se arrependa da compra, também poderá devolver o seu pedido em até 7 dias contados da data do
                recebimento do pedido no seu endereço.
            </p>
            <p>
                Como solicitar uma devolução por arrependimento:<br>
                Envie um e-mail para <span class="link-hover">loja@co2pecas.com.br</span> ou <span
                    class="link-hover">co2pecas.repcom@gmail.com</span>, informando seu nome completo e número do
                pedido.
                Você
                receberá o reembolso em até 30 dias contados da data em que recebermos os produtos devolvidos. O valor
                será reembolsado utilizando o mesmo método de pagamento que você selecionou ao comprar na nossa loja
                virtual. Não haverá custo adicional para você receber o reembolso.
            </p>
            <p>
                Como solicitar uma devolução de produtos com defeito:<br>
                Envie um e-mail para <span class="link-hover">loja@co2pecas.com.br</span> ou <span
                    class="link-hover">co2pecas.repcom@gmail.com</span>, informando seu nome completo, número do pedido
                e
                informações sobre o defeito de fabricação (descrição com fotos ou vídeos). Analisaremos o seu caso em
                até
                30 dias contados da data em que recebermos os produtos devolvidos. O valor será reembolsado utilizando o
                mesmo método de pagamento que você selecionou ao comprar na nossa loja virtual e em último caso, por
                conta
                de algum infortúnio, via transferência ou PIX. Não haverá custo adicional para você receber o reembolso.
            </p>
            <h6 id="scrollspyHeading3-3">Como Devolver os Produtos</h6>
            <p>
                Seguindo o estabelecido pelo Direito do Consumidor, os custos de envio da devolução de produtos com
                defeito de
                fabricação serão cobertos pela nossa loja através do
                processo de logística reversa. Em caso de devolução por arrependimento o custo de transporte do produto
                até o endereço da <a target="_blank" href="index.php"><em>CO2 Peças</em></a> será por conta do
                comprador.
                Não cobrimos
                os custos de embalagem, por isso, sugerimos que você utilize a mesma embalagem na qual recebeu a sua
                compra (caso não esteja danificada) ou uma caixa adequada que preserve as peças durante o transporte.
            </p>
            <h4 id="scrollspyHeading4">Políticas de Cookies</h4>
            <p>Esta Política de Cookies explica como utilizamos os cookies e tecnologias similares em nosso website <a
                    target="_blank" href="index.php"><em>CO2 Peças</em></a>. Ao continuar a utilizar nosso website, você
                concorda com o uso de cookies de acordo com esta política.</p>


            <p>Cookies são pequenos arquivos de texto que um site ou serviço online armazena no navegador do usuário.
                Esses arquivos contêm informações sobre a atividade do usuário no site e podem ser utilizados para
                diversas finalidades, como melhorar a experiência do usuário, analisar o tráfego, personalizar conteúdo,
                entre outros.</p>


            <p>Utilizamos cookies por meio de nossos parceiros de serviços de análise e publicidade para coletar
                informações sobre o uso do nosso website. Essas informações nos ajudam a melhorar a qualidade do nosso
                site e a personalizar a experiência do usuário. Os cookies também são utilizados para rastrear métricas
                importantes, como o número de visitantes, o tempo de permanência no site e as páginas mais acessadas.
            </p>

            <h4>Tipos de cookies utilizados:</h4>
            <p>1. Cookies essenciais: São cookies necessários para o funcionamento básico do nosso website. Eles
                permitem que você navegue pelo site e utilize seus recursos;</p>
            <p>2. Cookies de desempenho: Esses cookies coletam informações anônimas sobre como os usuários interagem com
                o site, quais páginas são visitadas com mais frequência e se há erros. Essas informações nos ajudam a
                aprimorar a funcionalidade do site e a entender como nossos visitantes interagem com ele;</p>
            <p>3. Cookies de funcionalidade: Esses cookies permitem que o site lembre de escolhas feitas pelo usuário
                (como nome de usuário, idioma ou região) e forneça recursos personalizados para uma experiência mais
                conveniente;</p>
            <p>4. Cookies de publicidade: Utilizamos cookies de terceiros para veicular anúncios relevantes aos
                visitantes do nosso site. Esses cookies rastreiam informações sobre suas visitas ao nosso site e outros
                sites para fornecer anúncios mais relevantes com base em seus interesses.</p>


            <p>Os navegadores da web geralmente permitem que você controle os cookies através de suas configurações.
                Você pode optar por bloquear todos os cookies, aceitar apenas cookies de sites específicos ou receber um
                aviso antes que um cookie seja armazenado. Observe que bloquear cookies pode afetar a funcionalidade do
                site e limitar sua experiência como usuário.</p>


            <p>Esta política de cookies pode ser atualizada periodicamente para refletir mudanças em nossas práticas de
                cookies. Quaisquer alterações significativas serão destacadas em nosso site ou notificadas por outros
                meios, como por e-mail.</p>

            <p>Se tiver alguma dúvida ou preocupação sobre nossa política de cookies, entre em contato conosco através
                dos canais de comunicação fornecidos em nosso site.</p>
            <p>Ao utilizar nosso website, você concorda com o uso de cookies de acordo com esta Política de Cookies. Se
                não concorda com o uso de cookies, por favor, ajuste as configurações do seu navegador ou pare de usar
                nosso site.</p>
            <p>Obrigado por visitar <a target="_blank" href="index.php"><em>CO2 Peças</em></a>!</p>

        </div>
        <div class="divider"></div>
    </main>

    <footer class="py-3 my-4">
        <ul class="nav justify-content-center pt-2 pb-3 mb-3">
            <li class="nav-item"><a href="policies.php"
                    class="nav-link px-2 link-body-emphasis text-primary">Políticas</a>
            </li>
            <li class="nav-item"><a href="terms.html" class="nav-link px-2 link-body-emphasis text-primary">Termos
                    de
                    uso</a></li>
            <li class="nav-item"><a href="contacts.html"
                    class="nav-link px-2 link-body-emphasis text-primary">Contatos</a>
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

    <script type="text/javascript">
        var direitosAutorais = document.getElementById('direitos-autorais');
        var anoAtual = new Date().getFullYear();
        direitosAutorais.innerHTML = '&copy; ' + anoAtual + '. Todos os direitos reservados';
    </script>
    <script src="ext/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>