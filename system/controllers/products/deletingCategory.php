<?php
require_once('../../../config/config.php');
require('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
        http_response_code(400);
        echo "Erro: ID inválido.";
        exit;
    }

    deletingCategory($id, $pdo);
    echo 'Success!';

} else {
    http_response_code(405);
    echo "Erro: Método não permitido. Este script suporta apenas solicitações POST.";
    exit;
}

