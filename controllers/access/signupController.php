<?php

require_once('../../config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = isset($_POST['nameCreate']) ? $_POST['nameCreate'] : null;
    $email = isset($_POST['emailCreate']) ? $_POST['emailCreate'] : null;
    $password = isset($_POST['passwordCreate']) ? $_POST['passwordCreate'] : null;
    $passwordConfirm = isset($_POST['passwordCreate2']) ? $_POST['passwordCreate2'] : null;
    $agreement = isset($_POST['userAgreed']) ? $_POST['userAgreed'] : null;

    if (empty($name) || empty($email) || empty($password) || empty($passwordConfirm) || empty($agreement)) {
        http_response_code(400);
        echo "Erro: Todos os campos devem ser preenchidos.";
        exit;
    }

    if ($password != $passwordConfirm) {
        echo "As senhas não coincidem!";
        exit;
    }

    $passwordCrip = hash('sha256', $password);
    $pdo->beginTransaction();

    try {
        $res = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $res->bindValue(":email", $email);
        $res->execute();
        $result = $res->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            echo "Este e-mail já está cadastrado! Recupere a senha de sua conta caso tenha esquecido.";
            exit();
        } else {
            $insertUser = $pdo->prepare("INSERT INTO users (fullname, email, password_crip, user_type) VALUES (:fullname, :email, :password_crip, :user_type)");
            $insertUser->bindValue(":fullname", $name);
            $insertUser->bindValue(":email", $email);
            $insertUser->bindValue(":password_crip", $passwordCrip);
            $insertUser->bindValue(":user_type", "client");
            $insertUser->execute();
            $pdo->commit();
            echo 'Success!';

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
