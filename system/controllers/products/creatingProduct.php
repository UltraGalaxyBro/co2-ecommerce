<?php

require_once('../../../config/config.php');
require('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //PRIMEIRA LINHA
    $name = $_POST['nameCreate'];
    $category = $_POST['categoryCreate'];
    $automaker = $_POST['automakerCreate'];
    $inside_code = $_POST['insideCodeCreate'];
    //SEGUNDA LINHA
    $original_code = $_POST['originalCodeCreate'];
    $brand = $_POST['brandCreate'];
    $brand_code = $_POST['brandCodeCreate'];
    $state = $_POST['stateCreate'];
    //TERCEIRA LINHA
    $inventory = $_POST['inventoryCreate'];
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
    //SEXTA LINHA (DE IMAGENS) ESTÁ MAIS AO FINAL DO CÓDIGO NA HORA DE INSERIR NO BANCO DE DADOS E NO DIRETÓRIO

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

    if (!empty($original_code) && empty($brand_code)) {
        // Verificar duplicatas por código original
        $stmt = $pdo->prepare("SELECT * FROM products WHERE original_code = :original_code AND brand_code = 'INDEFINIDO'");
        $stmt->bindParam(':original_code', $original_code);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($results) > 0) {
            echo 'Já existe produto com o código original "' . $original_code . '" cadastrado no sistema.';
            exit;
        }
    }

    if (!empty($brand_code)) {
        // Verificar duplicatas por código de fabricante
        $brand_code = mb_strtoupper($brand_code, 'UTF-8');
        $stmt = $pdo->prepare("SELECT * FROM products WHERE brand_code = :brand_code");
        $stmt->bindParam(':brand_code', $brand_code);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($results) > 0) {
            echo 'Já existe produto com o código de fabricante "' . $brand_code . '" cadastrado no sistema.';
            exit;
        }
    } else {
        $brand_code = 'INDEFINIDO';
    }

    if ($inventory == 'LOCAL' && (empty($localization) || empty($quantity))) {
        echo "Se o produto estiver em tipo de estoque LOCAL os campos 'Localização' e 'Estoque' devem estar preenchidos.";
        exit;
    }

    if ($inventory == 'LOCAL' && !empty($localization)) {
        $localization = mb_strtoupper($localization, 'UTF-8');
    }

    if ($inventory == 'LOCAL' && !empty($quantity) && empty($quantity_min)) {
        $quantity_min = 1;
    }

    if ($inventory == 'VIRTUAL') {
        $localization = null;
        $quantity = null;
        $quantity_min = null;
    }

    checkEmptyOrNull($cost, 'Custo (R$)');
    $cost = str_replace(',', '.', $cost);

    if (empty($price)) {
        $priceAditional = 0;
        $priceExpanded = 0;
        $priceAditional = 27.5 / 100;
        $priceExpanded = $cost * $priceAditional;
        $price = $cost + $priceExpanded;
    }

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
    $name_url = str_replace(' ', '_', $name_url);

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

    //USANDO AS FUNÇÕES PARA UPLOAD E REDIMENSIONAMENTO DE IMAGENS
    $main_path_img = "../../../assets/img/products/";
    $aditional_path_img = "../../../assets/img/products/extra/";

    if (empty($_FILES['imgCreate']['name'])) {
        $img0 = "default-image.png";
    } else {
        $img0 = uploadImage('imgCreate', $main_path_img, $name_url, $original_code_url, $brand_code_url, 'imagemPrincipal');
    }

    if (empty($_FILES['imgCreate1']['name'])) {
        $img1 = "default-image.png";
    } else {
        $img1 = uploadImage('imgCreate1', $aditional_path_img, $name_url, $original_code_url, $brand_code_url, 'imagemExtra1');
    }

    if (empty($_FILES['imgCreate2']['name'])) {
        $img2 = "default-image.png";
    } else {
        $img2 = uploadImage('imgCreate2', $aditional_path_img, $name_url, $original_code_url, $brand_code_url, 'imagemExtra2');
    }


    $pdo->beginTransaction();

    try {
        $sql = "INSERT INTO products (name, category, automaker, original_code, brand, brand_code, aplication, state, inventory, localization, quantity, quantity_min, cost, price, promotional, promotional_date, promotional_price, visible, name_url, description, keywords";

        if ($img0 != "default-image.png") {
            $sql .= ", img0";
        }

        if ($img1 != 'default-image.png') {
            $sql .= ", img1";
        }

        if ($img2 != 'default-image.png') {
            $sql .= ", img2";
        }

        $sql .= ", first_record, last_record) VALUES (:name, :category, :automaker, :original_code, :brand, :brand_code, :aplication, :state, :inventory, :localization, :quantity, :quantity_min, :cost, :price, :promotional, :promotional_date, :promotional_price, :visible, :name_url, :description, :keywords";

        if ($img0 != "default-image.png") {
            $sql .= ", :img0";
        }

        if ($img1 != 'default-image.png') {
            $sql .= ", :img1";
        }

        if ($img2 != 'default-image.png') {
            $sql .= ", :img2";
        }

        $sql .= ", NOW(), NOW())";

        $res = $pdo->prepare($sql);
        $res->bindValue(":name", $name);
        $res->bindValue(":category", $category);
        $res->bindValue(":automaker", $automaker);
        $res->bindValue(":original_code", $original_code);
        $res->bindValue(":brand", $brand);
        $res->bindValue(":brand_code", $brand_code);
        $res->bindValue(":aplication", $aplication);
        $res->bindValue(":state", $state);
        $res->bindValue(":inventory", $inventory);
        $res->bindValue(":localization", $localization);
        $res->bindValue(":quantity", $quantity);
        $res->bindValue(":quantity_min", $quantity_min);
        $res->bindValue(":cost", $cost);
        $res->bindValue(":price", $price);
        $res->bindValue(":promotional", $promotional);
        $res->bindValue(":promotional_date", $promotional_date);
        $res->bindValue(":promotional_price", $promotional_price);
        $res->bindValue(":visible", $visible);
        $res->bindValue(":name_url", $name_url);
        $res->bindValue(":description", $description);
        $res->bindValue(":keywords", $keywords);

        if ($img0 != "default-image.png") {
            $res->bindValue(":img0", $img0);
        }

        if ($img1 != 'default-image.png') {
            $res->bindValue(":img1", $img1);
        }

        if ($img2 != 'default-image.png') {
            $res->bindValue(":img2", $img2);
        }

        if ($res->execute()) {
            //VERIFFICAÇÃO SE TAL CATEGORIA EXISTE. CASO NÃO, ADICIONE-A NO BANCO DE DADOS
            creatingCategory($category, $pdo);

            //VERIFFICAÇÃO SE TAL MARCA EXISTE. CASO NÃO, ADICIONE-A NO BANCO DE DADOS
            creatingBrand($brand, $pdo);

            $pdo->commit();
            echo 'Success!';
        } else {
            echo "Erro: " . $res->errorInfo()[2];
            $pdo->rollBack();
        }
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Erro ao criar a conta: " . $e->getMessage();
    }
} else {
    http_response_code(405);
    echo "Erro: Método não permitido. Este script suporta apenas solicitações POST.";
    exit;
}
