<?php

require_once('../../config/config.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = isset($_POST['emailLogin']) ? $_POST['emailLogin'] : null;
    $password = isset($_POST['passwordLogin']) ? $_POST['passwordLogin'] : null;

    if (empty($email) || empty($password)) {
        http_response_code(400);
        echo "Erro: Todos os campos devem ser preenchidos.";
        exit;
    }

    $passwordCrip = hash('sha256', $password);
    $pdo->beginTransaction();

    try {
        $res = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password_crip = :password_crip");
        $res->bindValue(":email", $email);
        $res->bindValue(":password_crip", $passwordCrip);
        $res->execute();
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            $_SESSION['id'] = $result[0]['id'];
            $_SESSION['user_type'] = $result[0]['user_type'];
            switch ($result[0]['user_type']) {
                case 'admin':
                    echo json_encode(array('success' => true, 'redirect' => 'system/index.php'));
                    break;

                case 'employee':
                    echo json_encode(array('success' => true, 'redirect' => 'system/index.php'));
                    break;

                case 'client':
                    echo json_encode(array('success' => true, 'redirect' => 'index.php'));
                    break;

                default:
                    echo "Não foi possível reconhecer o nível do usuário!";
                    break;
            }
        } else {
            echo "Dados inválidos.";
            exit;
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
