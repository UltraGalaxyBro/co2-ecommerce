<?php
require_once('../../../config/config.php');
require('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idDelete'])) {
    
    $id = filter_var($_POST['idDelete'], FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
        http_response_code(400);
        echo "Erro: ID inválido.";
        exit;
    }

    $main_path_img = "../../../assets/img/products/";
    $aditional_path_img = "../../../assets/img/products/extra/";

    try {
        $pdo->beginTransaction();

        $delImgs = $pdo->prepare("SELECT img0, img1, img2 FROM products WHERE id = :id");
        $delImgs->bindValue(":id", $id);
        $delImgs->execute();

        $result = $delImgs->fetchAll(PDO::FETCH_ASSOC);
        $img0 = $result[0]['img0'];
        $img1 = $result[0]['img1'];
        $img2 = $result[0]['img2'];

        if (!empty($img0) && $img0 != 'default-image.png') {
            eraseImage($img0, $main_path_img);
        }

        if (!empty($img1) && $img1 != 'default-image.png') {
            eraseImage($img1, $aditional_path_img);
        }

        if (!empty($img2) && $img2 != 'default-image.png') {
            eraseImage($img2, $aditional_path_img);
        }

        $sql = "DELETE FROM products WHERE id = :id";
        $res = $pdo->prepare($sql);
        $res->bindValue(":id", $id);
        $res->execute();

        $pdo->commit();
        echo 'Success!';

    } catch (Exception $e) {
        $pdo->rollBack();
        error_log("Erro na transação: " . $e->getMessage());
        echo "Erro ao excluir o produto. Por favor, tente novamente mais tarde.";
    }

} else {
    http_response_code(405);
    echo "Erro: Método não permitido. Este script suporta apenas solicitações POST.";
    exit;
}

