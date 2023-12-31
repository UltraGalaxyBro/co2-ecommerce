<?php

require_once('../../../config/config.php');
require('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['idEdit']) {
    $id = $_POST['idEdit'];
    //PRIMEIRA LINHA
    $name = $_POST['nameEdit'];
    $category = $_POST['categoryEdit'];
    $automaker = $_POST['automakerEdit'];
    $inside_code = $_POST['insideCodeEdit'];
    //SEGUNDA LINHA
    $original_code = $_POST['originalCodeEdit'];
    $brand = $_POST['brandEdit'];
    $brand_code = $_POST['brandCodeEdit'];
    $state = $_POST['stateEdit'];
    //TERCEIRA LINHA
    $inventory = $_POST['inventoryEdit'];
    $localization = $_POST['localizationEdit'];
    $quantity = $_POST['quantityEdit'];
    $quantity_min = $_POST['quantityMinEdit'];
    //QUARTA LINHA
    $cost = $_POST['costEdit'];
    $price = $_POST['priceEdit'];
    $promotional = isset($_POST['promotionalEdit']) ? 1 : 0; // 1 se marcado, 0 se não marcado
    $promotional_date = $_POST['promotionalDateEdit'];
    $promotional_price = $_POST['promotionalPriceEdit'];
    //QUINTA LINHA
    $visible = isset($_POST['visibleEdit']) ? 1 : 0; // 1 se marcado, 0 se não marcado
    $aplication = $_POST['aplicationEdit'];
    $description = $_POST['descriptionEdit'];
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
        $old_original_code = $_POST['oldOriginalCode'];
        if ($original_code != $old_original_code) {
            $stmt = $pdo->prepare("SELECT * FROM products WHERE original_code = :original_code AND brand_code = 'INDEFINIDO'");
            $stmt->bindParam(':original_code', $original_code);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                echo 'Já existe produto com o código original "' . $original_code . '" cadastrado no sistema.';
                exit;
            }
        }
    }


    if (!empty($brand_code)) {
        // Verificar duplicatas por código de fabricante
        $old_brand_code = $_POST['oldBrandCode'];
        if ($brand_code != $old_brand_code) {
            $brand_code = mb_strtoupper($brand_code, 'UTF-8');
            $stmt = $pdo->prepare("SELECT * FROM products WHERE brand_code = :brand_code");
            $stmt->bindParam(':brand_code', $brand_code);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                echo 'Já existe produto com o código de fabricante "' . $brand_code . '" cadastrado no sistema.';
                exit;
            }
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

    if (!empty($_POST['imgDelLog']) || !empty($_POST['imgDelLog1']) || !empty($_POST['imgDelLog2'])) {
        $oldImg = $_POST['imgEditTxt'];
        $oldImg1 = $_POST['imgEditTxt1'];
        $oldImg2 = $_POST['imgEditTxt2'];

        $updatingImages = "UPDATE products SET ";
        if (!empty($_POST['imgDelLog'])) {

            $updatingImages .= "img0 = null, img1 = null, img2 = null ";
            if (!empty($oldImg)) {
                eraseImage($oldImg, $main_path_img);
            }
            if (!empty($oldImg1)) {
                eraseImage($oldImg1, $aditional_path_img);
            }
            if (!empty($oldImg2)) {
                eraseImage($oldImg2, $aditional_path_img);
            }
        } elseif (!empty($_POST['imgDelLog1'])) {
            $updatingImages .= "img1 = null, img2 = null ";
            if (!empty($oldImg1)) {
                eraseImage($oldImg1, $aditional_path_img);
            }
            if (!empty($oldImg2)) {
                eraseImage($oldImg2, $aditional_path_img);
            }
        } else {
            $updatingImages .= "img2 = null ";
            if (!empty($oldImg2)) {
                eraseImage($oldImg2, $aditional_path_img);
            }
        }
        $updatingImages .= "WHERE id = :id";

        try {
            $pdo->beginTransaction();
            $resImgUpd = $pdo->prepare($updatingImages);
            $resImgUpd->bindValue(":id", $id);
            $resImgUpd->execute();
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Erro na transação: " . $e->getMessage();
        }
    }

    if (!empty($_FILES['imgEdit']['name'])) {
        $img0 = uploadImage('imgEdit', $main_path_img, $name_url, $original_code_url, $brand_code_url, 'imagemPrincipal');
    } else {
        $img0 = "default-image.png";
    }

    if (!empty($_FILES['imgEdit1']['name'])) {
        $img1 = uploadImage('imgEdit1', $aditional_path_img, $name_url, $original_code_url, $brand_code_url, 'imagemExtra1');
    } else {
        $img1 = "default-image.png";
    }

    if (!empty($_FILES['imgEdit2']['name'])) {
        $img2 = uploadImage('imgEdit2', $aditional_path_img, $name_url, $original_code_url, $brand_code_url, 'imagemExtra2');
    } else {
        $img2 = "default-image.png";
    }

    $pdo->beginTransaction();

    try {

        $sql = "UPDATE products SET name = :name, category = :category, automaker = :automaker, original_code = :original_code, brand = :brand, brand_code = :brand_code, aplication = :aplication, state = :state, inventory = :inventory, localization = :localization, quantity = :quantity, quantity_min = :quantity_min, cost = :cost, price = :price, promotional = :promotional, promotional_date = :promotional_date, promotional_price = :promotional_price, visible = :visible, name_url = :name_url, description = :description, keywords = :keywords";

        if ($img0 != "default-image.png") {
            $sql .= ", img0 = :img0";
        }

        if ($img1 != 'default-image.png') {
            $sql .= ", img1 = :img1";
        }

        if ($img2 != 'default-image.png') {
            $sql .= ", img2 = :img2";
        }

        $sql .= ", last_record = NOW() WHERE id = :id";

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

        $res->bindValue(":id", $id);

        if ($res->execute()) {
            //VERIFFICAÇÃO SE TAL CATEGORIA EXISTE. CASO NÃO, ADICIONE-A NO BANCO DE DADOS
            $stmt = $pdo->prepare("SELECT * FROM categories WHERE name = :name");
            $stmt->bindParam(':name', $category);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) == 0) {
                $sqlCategory = "INSERT INTO categories (name) VALUE (:name)";
                $resCategory = $pdo->prepare($sqlCategory);
                $resCategory->bindValue(":name", $category);
                $resCategory->execute();
            }

            //VERIFFICAÇÃO SE TAL MARCA EXISTE. CASO NÃO, ADICIONE-A NO BANCO DE DADOS
            $stmt = $pdo->prepare("SELECT * FROM brands WHERE name = :name");
            $stmt->bindParam(':name', $brand);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) == 0) {
                $sqlBrand = "INSERT INTO brands (name) VALUE (:name)";
                $resBrand = $pdo->prepare($sqlBrand);
                $resBrand->bindValue(":name", $brand);
                $resBrand->execute();
            }

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
