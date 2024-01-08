<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (@$_SESSION['id'] == null || ($_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'employee')) {
    echo "<script language='javascript'>window.location='../access.php'</script>";
}

require_once("../config/config.php");

?>

<!doctype html>
<html lang="pt-BR" data-bs-theme="auto">

<head>
    <script src="../assets/js/themes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="CO2 Peças, Pablo Nogueira de Faria">
    <link rel="icon" href="../assets/img/logo.png" type="image/png">
    <title>CO2 Peças | Produtos</title>
    <link href="../ext/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../ext/datatables/datatables.min.css">
    <link href="../assets/css/system.css" rel="stylesheet">
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="file"] {
            width: 138px;
            margin-bottom: 10px;
            /* Ou um valor de largura de sua preferência */
        }

        .dt-buttons .btn {
            padding: 5px 10px;
            margin: 10px;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <!--BOTÃO PARA TROCAS OS TEMAS - início-->
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
    <!--BOTÃO PARA TROCAS OS TEMAS - fim-->

    <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="index.php"><img src="../assets/img/logo.svg" alt="Logo" width="40" height="40" class="d-inline-block"> <strong><em>CO2
                    Peças</em></strong></a>
        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                    </svg>
                </button>
            </li>
        </ul>

    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- BARRA LATERAL - início-->
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
                <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel"><strong><em>CO2 Peças</em></strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" aria-current="page" href="index.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                                    </svg>
                                    Página inicial
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="budgets.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                                        <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z" />
                                        <path d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm0 2h4v1H2zm5-6h2v1H7zm3 0h2v1h-2zM7 8h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2z" />
                                    </svg>
                                    Orçamentos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="products.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
                                        <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567zM7.5 9.933l-2.75 1.571v3.134l2.75-1.571zm1 3.134 2.75 1.571v-3.134L8.5 9.933zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134zM5.258 2.643 8 4.21l2.742-1.567L8 1.076zM15 9.933l-2.75 1.571v3.134L15 13.067zM3.75 14.638v-3.134L1 9.933v3.134z" />
                                    </svg>
                                    Produtos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="../sales.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
                                        <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518z" />
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11m0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12" />
                                    </svg>
                                    Vendas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="customers.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                    </svg>
                                    Clientes
                                </a>
                            </li>
                            <?php
                            if ($_SESSION['user_type'] == 'admin') {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2" href="employees.php">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                            <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                                            <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12z" />
                                        </svg>
                                        Funcionários
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>

                        <hr class="my-3">

                        <ul class="nav flex-column mb-auto">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="account.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                                    </svg>
                                    Minha conta
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="../index.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                        <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z" />
                                    </svg>
                                    Ir à loja
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="../controllers/access/logoutController.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                                    </svg>
                                    Sair
                                </a>
                            </li>
                        </ul>

                        <hr class="my-3">

                        <ul class="nav flex-column mb-auto">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-down" viewBox="0 0 16 16">
                                        <path d="M12.5 9a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7m.354 5.854 1.5-1.5a.5.5 0 0 0-.708-.708l-.646.647V10.5a.5.5 0 0 0-1 0v2.793l-.646-.647a.5.5 0 0 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0Z" />
                                        <path d="M12.096 6.223A4.92 4.92 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.493 4.493 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.525 4.525 0 0 1-.813-.927C8.5 14.992 8.252 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.552 4.552 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10c.262 0 .52-.008.774-.024a4.525 4.525 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4" />
                                    </svg>
                                    Backup
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- BARRA LATERAL - fim-->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!--CONTEÚDO DA PÁGINA - início-->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Produtos</h1>
                    <div id="export-buttons"></div>
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#manipulateCategoriesModal">Categorias</button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">+ Produto</button>
                </div>

                <!-- TABELA PRODUTOS - início -->
                <div class="table-responsive mb-5 align-items-center">
                    <table id="products" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </th>
                                <th class="text-center">Descrição</th>
                                <th class="text-center">Referência</th>
                                <th class="text-center"><small>Estoque</small></th>
                                <th class="text-center"><small>Locação</small></th>
                                <th class="text-center"><small>Qtd.</small></th>
                                <th class="text-center" style="font-size: 15px;"><small>Preço unitário</small></th>
                                <th class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                    </svg>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--
                            <tr>
                                <td>
                                    <img src="../assets/img/products/default-image.png" width="40px" alt="Imagem do produto">
                                </td>
                                <td>
                                    <small>
                                        ROLAMENTO VOLANTE DO MOTOR
                                    </small>
                                </td>
                                <td>
                                    <small>
                                        21102685 (VOLVO) • 631903H195 (FAG)
                                    </small>
                                </td>
                                <td>
                                    <small>
                                        LOCAL
                                    </small>
                                </td>
                                <td>
                                    <small>
                                        P3-T
                                    </small>
                                </td>
                                <td>
                                    <small>
                                        # 1
                                    </small>
                                </td>
                                <td>
                                    <small>
                                        R$ 320,80
                                    </small>
                                </td>
                                
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" title="Editar produto" class="btn btn-sm btn-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                        </button>
                                        <button type="button" title="Excluir produto" class="btn btn-sm btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
                                                <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414l-3.879-3.879zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>-->
                        </tbody>
                    </table>
                </div>
                <!-- TABELA PRODUTOS - início -->

                <!--CONTEÚDO DA PÁGINA - fim-->

                <!-- Modal Categorias-->
                <div class="modal fade" id="manipulateCategoriesModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="Categorias" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Categorias</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal cadastrar Produto-->
                <div class="modal fade" id="createModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="Cadastrando produto" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalTitleCreate">Cadastrando produto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="createProduct" class="" method="post">
                                <div class="modal-body">
                                    <!--PRIMEIRA LINHA-->
                                    <div class="row gy-2 gx-3 align-items-center justify-content-center">

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="50" class="form-control" id="nameCreate" name="nameCreate">
                                                <label for="nameCreate">Nome do produto</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="25" class="form-control" id="categoryCreate" name="categoryCreate">
                                                <label for="categoryCreate">Categoria</label>
                                            </div>
                                            <div id="categorySuggestions"></div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <select class="form-select" id="automakerCreate" name="automakerCreate" aria-label="Floating label select example">
                                                    <option selected>Selecione</option>
                                                    <option value='MERCEDES'>MERCEDES</option>
                                                    <option value='VOLKSWAGEN'>VOLKSWAGEN</option>
                                                    <option value='VOLVO'>VOLVO</option>
                                                    <option value='SCANIA'>SCANIA</option>
                                                    <option value='FORD'>FORD</option>
                                                    <option value='IVECO'>IVECO</option>
                                                    <option value='Outras'>Outras</option>
                                                    <option value='Geral'>Geral</option>
                                                </select>
                                                <label for="automakerCreate">Montadora</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="30" class="form-control" id="insideCodeCreate" name="insideCodeCreate">
                                                <label for="insideCodeCreate">Código interno</label>
                                            </div>
                                        </div>

                                    </div>

                                    <!--SEGUNDA LINHA-->
                                    <div class="row gy-2 gx-3 align-items-center justify-content-center">

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="30" class="form-control" id="originalCodeCreate" name="originalCodeCreate">
                                                <label for="originalCodeCreate">Código original</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="25" class="form-control" id="brandCreate" name="brandCreate">
                                                <label for="brandCreate">Marca</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="30" class="form-control" id="brandCodeCreate" name="brandCodeCreate">
                                                <label for="brandCodeCreate">Código do fabricante</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <select class="form-select" id="stateCreate" name="stateCreate" aria-label="">
                                                    <option selected value='Novo'>Novo</option>
                                                    <option value='Seminovo'>Seminovo</option>
                                                </select>
                                                <label for="stateCreate">Condição</label>
                                            </div>
                                        </div>

                                    </div>

                                    <!--TERCEIRA LINHA-->
                                    <div id="optionsLocalInventory" class="row gy-2 gx-3 align-items-center justify-content-center">

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <select class="form-select" id="inventoryCreate" name="inventoryCreate" aria-label="Tipo de estoque do produto">
                                                    <option selected value='LOCAL'>LOCAL</option>
                                                    <option value='VIRTUAL'>VIRTUAL</option>
                                                </select>
                                                <label for="inventoryCreate">Tipo de estoque</label>
                                            </div>
                                        </div>

                                        <div id="atLocalOption1" class="col-md-3" style="display:none">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="20" class="form-control" id="localizationCreate" name="localizationCreate">
                                                <label for="localizationCreate">Localização</label>
                                            </div>
                                        </div>

                                        <div id="atLocalOption2" class="col-md-3" style="display:none">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="number" class="form-control" id="quantityCreate" name="quantityCreate">
                                                <label for="quantityCreate"><small>Estoque</small></label>
                                            </div>
                                        </div>

                                        <div id="atLocalOption3" class="col-md-3" style="display:none">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="number" class="form-control" id="quantityMinCreate" name="quantityMinCreate">
                                                <label for="quantityMinCreate"><small>Estoque baixo</small></label>
                                            </div>
                                        </div>

                                    </div>

                                    <!--QUARTA LINHA-->
                                    <div class="row gy-2 gx-3 align-items-center justify-content-center">

                                        <div class="col-md-2">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="number" step="0.01" class="form-control" id="costCreate" name="costCreate">
                                                <label for="costCreate">Custo (R$)</label>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="number" step="0.01" class="form-control" id="priceCreate" name="priceCreate">
                                                <label for="priceCreate">Preço (R$)</label>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="promotionalCreate" id="promotionalCreate">
                                                <label class="form-check-label" for="promotionalCreate">
                                                    Habilitar Promoção
                                                </label>
                                            </div>
                                        </div>

                                        <!-- VISIVEIS QUANDO A PROMOÇÃO ESTIVER MARCADA -->

                                        <div id="promotionalOptionCreate1" class="col-md-3" style="display: none;">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="date" class="form-control" id="promotionalDateCreate" name="promotionalDateCreate">
                                                <label for="promotionalDateCreate">Promoção válida até...</label>
                                            </div>
                                        </div>

                                        <div id="promotionalOptionCreate2" class="col-md-3" style="display: none;">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="number" step="0.01" class="form-control" id="promotionalPriceCreate" name="promotionalPriceCreate">
                                                <label for="promotionalPriceCreate">Promoção (R$)</label>
                                            </div>
                                        </div>

                                    </div>

                                    <!--QUINTA LINHA-->
                                    <div class="row gy-2 gx-3 align-items-center justify-content-center">

                                        <div class="col-md-3 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="visibleCreate" id="visibleCreate" checked>
                                                <label class="form-check-label" for="visibleCreate">
                                                    Visível em site
                                                </label>
                                            </div>
                                        </div>

                                        <div id="visibleOptionCreate1" class="col-md-5 mb-2" style="display: none;">
                                            <div class="form-floating">
                                                <textarea rows="1" maxlength="150" class="form-control" placeholder="" id="aplicationCreate" name="aplicationCreate"></textarea>
                                                <label for="aplicationCreate">Aplicação do produto</label>
                                            </div>
                                        </div>

                                        <div id="visibleOptionCreate2" class="col-md-4 mb-2" style="display: none;">
                                            <div class="form-floating">
                                                <textarea rows="1" maxlength="100" class="form-control" placeholder="" id="descriptionCreate" name="descriptionCreate"></textarea>
                                                <label for="descriptionCreate">Descrição do produto em site</label>
                                            </div>
                                        </div>

                                    </div>

                                    <!--SEXTA LINHA -->
                                    <div class="row gy-2 gx-3 align-items-center justify-content-center">

                                        <div class="col-md-6 mb-2">
                                            <div class="form-group text-center">
                                                <label><small><strong>Imagem principal</strong></small></label>
                                                <input type="file" value="" class="form-control-file" id="imgCreate" name="imgCreate" placeholder="Imagem">
                                                <img src="../assets/img/products/default-image.png" class="rounded" width="140" height="140" id="targetImgCreate" alt="Imagem principal do produto">
                                                <button class="btn btn-sm btn-outline-danger" type="button" onclick="clearImage('imgCreate', 'targetImgCreate')">X</button>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <div class="form-group text-center mb-2" style="display: none;">
                                                <label><small><strong>1ª imagem adicional</strong></small></label>
                                                <input type="file" value="" class="form-control-file" id="imgCreate1" name="imgCreate1" placeholder="Imagem">
                                                <img src="../assets/img/products/default-image.png" class="rounded" width="75" height="75" id="targetImgCreate1" alt="1ª imagem adicional do produto">
                                                <button class="btn btn-sm btn-outline-danger" type="button" onclick="clearImage('imgCreate1', 'targetImgCreate1')">X</button>
                                            </div>
                                            <div class="form-group text-center mb-2" style="display: none;">
                                                <label><small><strong>2ª imagem adicional</strong></small></label>
                                                <input type="file" value="" class="form-control-file" id="imgCreate2" name="imgCreate2" placeholder="Imagem">
                                                <img src="../assets/img/products/default-image.png" class="rounded" width="75" height="75" id="targetImgCreate2" alt="2ª imagem adicional do produto">
                                                <button class="btn btn-sm btn-outline-danger" type="button" onclick="clearImage('imgCreate2', 'targetImgCreate2')">X</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div id="loadingCreateProduct" style="display: none;" class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Processando...</span>
                                        </div>
                                        <div id="messageCreateProduct" class="fw-bold text-center"></div>
                                    </div>
                                    <button id="createProductBtn" type="submit" class="btn btn-primary">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal editar Produto-->
                <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="Editando produto" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalTitleCreate">Editando produto</h1>
                                <small><span id="editFirstRecord" class="mx-2 text-info"></span>
                                <span id="editLastRecord" class="mx-2 text-warning"></span></small>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="editProduct" method="post">
                                <div class="modal-body">
                                    <!--PRIMEIRA LINHA-->
                                    <div class="row gy-2 gx-3 align-items-center justify-content-center">

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="50" class="form-control" id="nameEdit" name="nameEdit">
                                                <label for="nameEdit">Nome do produto</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="25" class="form-control" id="categoryEdit" name="categoryEdit">
                                                <label for="categoryEdit">Categoria</label>
                                            </div>
                                            <div id="categorySuggestions"></div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <select class="form-select" id="automakerEdit" name="automakerEdit" aria-label="Opções de montadoras">
                                                    
                                                </select>
                                                <label for="automakerEdit">Montadora</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="30" class="form-control" id="insideCodeEdit" name="insideCodeEdit">
                                                <label for="insideCodeEdit">Código interno</label>
                                            </div>
                                        </div>

                                    </div>

                                    <!--SEGUNDA LINHA-->
                                    <div class="row gy-2 gx-3 align-items-center justify-content-center">

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="30" class="form-control" id="originalCodeEdit" name="originalCodeEdit">
                                                <label for="originalCodeEdit">Código original</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="25" class="form-control" id="brandEdit" name="brandEdit">
                                                <label for="brandEdit">Marca</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="30" class="form-control" id="brandCodeEdit" name="brandCodeEdit">
                                                <label for="brandCodeEdit">Código do fabricante</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <select class="form-select" id="stateEdit" name="stateEdit" aria-label="Condição do produto">
                                                    <option selected value='Novo'>Novo</option>
                                                    <option value='Seminovo'>Seminovo</option>
                                                </select>
                                                <label for="stateEdit">Condição</label>
                                            </div>
                                        </div>

                                    </div>

                                    <!--TERCEIRA LINHA-->
                                    <div class="row gy-2 gx-3 align-items-center justify-content-center">

                                        <div class="col-md-3">
                                            <div class="form-floating mb-2">
                                                <select class="form-select" id="inventoryEdit" name="inventoryEdit" aria-label="Tipo de estoque do produto">
                                                    
                                                </select>
                                                <label for="inventoryEdit">Tipo de estoque</label>
                                            </div>
                                        </div>

                                        <div id="atLocalOption4" class="col-md-3" style="display:none">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="text" maxlength="20" class="form-control" id="localizationEdit" name="localizationEdit">
                                                <label for="localizationEdit">Localização</label>
                                            </div>
                                        </div>

                                        <div id="atLocalOption5" class="col-md-3" style="display:none">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="number" class="form-control" id="quantityEdit" name="quantityEdit">
                                                <label for="quantityEdit"><small>Estoque</small></label>
                                            </div>
                                        </div>

                                        <div id="atLocalOption6" class="col-md-3" style="display:none">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="number" class="form-control" id="quantityMinEdit" name="quantityMinEdit">
                                                <label for="quantityMinEdit"><small>Estoque baixo</small></label>
                                            </div>
                                        </div>

                                    </div>

                                    <!--QUARTA LINHA-->
                                    <div class="row gy-2 gx-3 align-items-center justify-content-center">

                                        <div class="col-md-2">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="number" step="0.01" class="form-control" id="costEdit" name="costEdit">
                                                <label for="costEdit">Custo (R$)</label>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="number" step="0.01" class="form-control" id="priceEdit" name="priceEdit">
                                                <label for="priceEdit">Preço (R$)</label>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="promotionalEdit" id="promotionalEdit">
                                                <label class="form-check-label" for="promotionalEdit">
                                                    Habilitar Promoção
                                                </label>
                                            </div>
                                        </div>

                                        <!-- VISIVEIS QUANDO A PROMOÇÃO ESTIVER MARCADA -->

                                        <div id="promotionalOptionEdit4" class="col-md-3" style="display: none;">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="date" class="form-control" id="promotionalDateEdit" name="promotionalDateEdit">
                                                <label for="promotionalDateEdit">Promoção válida até...</label>
                                            </div>
                                        </div>

                                        <div id="promotionalOptionEdit5" class="col-md-3" style="display: none;">
                                            <div class="form-floating mb-2">
                                                <input placeholder="" type="number" step="0.01" class="form-control" id="promotionalPriceEdit" name="promotionalPriceEdit">
                                                <label for="promotionalPriceEdit">Promoção (R$)</label>
                                            </div>
                                        </div>

                                    </div>

                                    <!--QUINTA LINHA-->
                                    <div class="row gy-2 gx-3 align-items-center justify-content-center">

                                        <div class="col-md-3 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="visibleEdit" id="visibleEdit">
                                                <label class="form-check-label" for="visibleEdit">
                                                    Visível em site
                                                </label>
                                            </div>
                                        </div>

                                        <div id="visibleOptionEdit1" class="col-md-5 mb-2" style="display: none;">
                                            <div class="form-floating">
                                                <textarea rows="1" maxlength="150" class="form-control" placeholder="" id="aplicationEdit" name="aplicationEdit"></textarea>
                                                <label for="aplicationEdit">Aplicação do produto</label>
                                            </div>
                                        </div>

                                        <div id="visibleOptionEdit2" class="col-md-4 mb-2" style="display: none;">
                                            <div class="form-floating">
                                                <textarea rows="1" maxlength="100" class="form-control" placeholder="" id="descriptionEdit" name="descriptionEdit"></textarea>
                                                <label for="descriptionEdit">Descrição do produto em site</label>
                                            </div>
                                        </div>

                                    </div>

                                    <!--SEXTA LINHA -->
                                    <div class="row gy-2 gx-3 align-items-center justify-content-center">

                                        <div class="col-md-6 mb-2">
                                            <div class="form-group text-center">
                                                <label><small><strong>Imagem principal</strong></small></label>
                                                <input type="file" class="form-control-file" id="imgEdit" name="imgEdit" placeholder="Imagem">
                                                <img src="" class="rounded" width="140" height="140" id="targetImgEdit" alt="Imagem principal do produto">
                                                <button class="btn btn-sm btn-outline-danger" type="button" onclick="clearImage2('imgEdit', 'targetImgEdit')">X</button>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <div class="form-group text-center mb-2" style="display: none;">
                                                <label><small><strong>1ª imagem adicional</strong></small></label>
                                                <input type="file" value="" class="form-control-file" id="imgEdit1" name="imgEdit1" placeholder="Imagem">
                                                <img src="../assets/img/products/default-image.png" class="rounded" width="75" height="75" id="targetImgEdit1" alt="1ª imagem adicional do produto">
                                                <button class="btn btn-sm btn-outline-danger" type="button" onclick="clearImage2('imgEdit1', 'targetImgEdit1')">X</button>
                                            </div>
                                            <div class="form-group text-center mb-2" style="display: none;">
                                                <label><small><strong>2ª imagem adicional</strong></small></label>
                                                <input type="file" value="" class="form-control-file" id="imgEdit2" name="imgEdit2" placeholder="Imagem">
                                                <img src="../assets/img/products/default-image.png" class="rounded" width="75" height="75" id="targetImgEdit2" alt="2ª imagem adicional do produto">
                                                <button class="btn btn-sm btn-outline-danger" type="button" onclick="clearImage2('imgEdit2', 'targetImgEdit2')">X</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div id="loadingEditProduct" style="display: none;" class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Processando...</span>
                                        </div>
                                        <div id="messageEditProduct" class="fw-bold text-center"></div>
                                    </div>
                                    <input id="imgEditTxt" name="imgEditTxt" type="hidden">
                                    <input id="imgEditTxt1" name="imgEditTxt1" type="hidden">
                                    <input id="imgEditTxt2" name="imgEditTxt2" type="hidden">
                                    <input id="idEdit" name="idEdit" type="hidden">
                                    <button id="EditProductBtn" type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal excluir Produto-->
                <div class="modal fade" id="deleteModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="Excluindo produto" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluindo produto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary">Excluir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="../ext/jquery/jquery-3.7.1.js"></script>
    <script src="../ext/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../ext/datatables/datatables.min.js"></script>
    <script src="../ext/datatables/pdfmake.min.js"></script>
    <script src="../ext/datatables/vfs_fonts.js"></script>
    <script src="../ext/datatables/moment.min.js"></script>
    <script src="../assets/js/custom-datatables.js"></script>
    <script src="../assets/js/products-system.js"></script>
</body>

</html>