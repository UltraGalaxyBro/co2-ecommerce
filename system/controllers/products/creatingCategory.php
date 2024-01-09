<?php

require_once('../../../config/config.php');
require('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nameCategory = $_POST['makingCategory'];
    checkEmptyOrNull($nameCategory, 'Categoria nova');
    creatingCategory($nameCategory, $pdo);
    echo 'Success!';
} else {
    http_response_code(405);
    echo "Erro: Método não permitido. Este script suporta apenas solicitações POST.";
    exit;
}
