<?php

require_once('../../../config/config.php');

function checkEmptyOrNull($field, $fieldName)
{
    if (empty($field) || is_null($field)) {
        echo "O campo '$fieldName' não pode estar vazio ou nulo.";
        exit;
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //PRIMEIRA LINHA
    $name = $_POST['nameCreate'];
    $category = $_POST['categoryCreate'];
    $automaker = $_POST['automakerCreate'];
    $original_code = $_POST['originalCodeCreate'];
    //SEGUNDA LINHA
    $brand = $_POST['brandCreate'];
    $brand_code = $_POST['brandCodeCreate'];
    $state = $_POST['stateCreate'];
    $inventory = $_POST['inventoryCreate'];
    //TERCEIRA LINHA
    $localization = $_POST['localizationCreate'];
    $quantity = $_POST['quantityCreate'];
    $quantity_min = $_POST['quantityMinCreate'];
    //QUARTA LINHA
    $cost = $_POST['costCreate'];
    $price = $_POST['priceCreate'];
    $promotional = isset($_POST['promotionalCreate']) ? 1 : 0; // 1 se marcado, 0 se não marcado
    $promotional_date = $_POST['promotionalDateCreate'];
    $promotional_price = $_POST['promotionalPriceCreate'];
    //QUINTA LINHA
    $visible = isset($_POST['visibleCreate']) ? 1 : 0; // 1 se marcado, 0 se não marcado
    $aplication = $_POST['aplicationCreate'];
    $description = $_POST['descriptionCreate'];
    //SEXTA LINHA
    //$img0 = $_FILES['imgCreate'];
    //$img1 = $_FILES['imgCreate1'];
    //$img2 = $_FILES['imgCreate2'];

    if (!empty($original_code)) {
        $original_code = mb_strtoupper($original_code, 'UTF-8');
    }

    if (!empty($brand_code)) {
        $brand_code = mb_strtoupper($brand_code, 'UTF-8');
    }

    checkEmptyOrNull($name, 'Nome do produto');
    $name = ucwords($name);
    checkEmptyOrNull($category, 'Categoria');
    $category = ucwords($category);
    checkEmptyOrNull($automaker, 'Montadora');

    if (empty($original_code) && empty($brand_code)) {
        echo "Deve ter ao menos um código de referência, seja inserido no campo 'Código original' e/ou no campo 'Código do fabricante'.";
        exit;
    }

    if (!empty($original_code) && empty($brand)) {
        $brand = "GENUINE PARTS";
        $brand_code = null;
    }

    if (empty($brand) && !empty($brand_code)) {
        checkEmptyOrNull($brand, 'Marca');
    }

    if (empty($original_code)) {
        $original_code = 'INDEFINIDO';
    } else {
        $original_code = mb_strtoupper($original_code, 'UTF-8');
    }

    if (empty($brand_code)) {
        $brand_code = 'INDEFINIDO';
    } else {
        $brand_code = mb_strtoupper($brand_code, 'UTF-8');

    }

    if ($inventory == 'LOCAL' && (empty($localization) || empty($quantity))) {
        echo "Se o produto estiver em tipo de estoque LOCAL os campos 'Localização' e 'Estoque' devem estar preenchidos.";
        exit;
    }

    if ($inventory == 'LOCAL' && !empty($localization)) {
        $localization = mb_strtoupper($localization, 'UTF-8');
    }

    if ($inventory == 'LOCAL' && !empty($quantity) && empty($quantity_min)) {
        $quantity_min == 1;
    }

    if ($inventory == 'VIRTUAL') {
        $localization == null;
        $quantity == null;
        $quantity_min == null;
    }

    checkEmptyOrNull($cost, 'Custo (R$)');
    $cost = str_replace(',', '.', $cost);
    checkEmptyOrNull($price, 'Preço (R$)');
    $price = str_replace(',', '.', $price);

    if ($promotional == 1 && (empty($promotional_date) || empty($promotional_price))) {
        echo "Para deixar o produto em promoção é necessário que os campos 'Promoção válida até...' e 'Promoção (R$)' estejam preenchidos.";
        exit;
    } elseif ($promotional == 0) {
        $promotional_date = null;
        $promotional_price = null;
    } else {
        $promotional_price = str_replace(',', '.', $promotional_price);
    }

    if ($visible == 1 && empty($aplication)) {
        echo "Se o produto ficará visível aos clientes no site, ele deve conter a sua aplicação. O campo 'Aplicação' não pode estar vazio ou nulo.";
        exit;
    }

    // CONFIGURANDO AS PALAVRAS-CHAVES
    $brand_code_formated = ($brand_code !== 'INDEFINIDO') ? $brand_code . ', ' : '';
    $original_code_formated = ($original_code !== 'INDEFINIDO') ? $original_code . ', ' : '';
    $keywords = $original_code_formated . $brand_code_formated . $name . ', ' . $category;

    //CONFIGURANDO URL AMIGÁVEL DO PRODUTO
    $transform_name1 = str_replace('/', '-', $name);
    $transform_name2 = strtolower(preg_replace("[^a-zA-Z0-9-]", "-", strtr(utf8_decode(trim($transform_name1)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
    $name_url = str_replace(array('/', '.'), '-', $transform_name2);

    // MODELANDO AS CONFIGURAÇÕES DA IMAGEM ANTES DE SALVAR NO BANCO DE DADOS E SUBI-LA
    if ($original_code == 'INDEFINIDO') {
        $original_code_url = '';
    } else {
        $original_code_url = str_replace(array('/', '.'), '-', $original_code);
    }

    if ($brand_code == 'INDEFINIDO') {
        $brand_code_url = '';
    } else {
        $brand_code_url = str_replace(array('/', '.'), '-', $brand_code);
    }

    $$pdo->beginTransaction();

    try {
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Erro ao criar a conta: " . $e->getMessage();
    }
} else {
    http_response_code(405);
    echo "Erro: Método não permitido. Este script suporta apenas solicitações POST.";
    exit;
}
