<?php

require_once('../../../../config/config.php');

header("Content-Type: application/json");

$apiKey = isset($_GET['api_key']) ? $_GET['api_key'] : null;

if ($apiKey !== $apiLockProducts) {
    echo json_encode(["error" => "Chave de API inválida."]);
    exit();
}

$route = isset($_GET['route']) ? $_GET['route'] : null;

// Função para buscar todos os produtos
function getAll($pdo)
{

    try {
        $stmt = $pdo->query('SELECT * FROM products');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode(["data" => $results]);
    } catch (PDOException $e) {
        return json_encode(["error" => "Erro ao buscar todos os produtos"]);
    }
}

// Função para buscar todos os produtos em estoque LOCAL
function getAllLocal($pdo)
{

    try {
        $stmt = $pdo->query('SELECT * FROM products WHERE inventory = "LOCAL"');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode(["data" => $results]);
    } catch (PDOException $e) {
        return json_encode(["error" => "Erro ao buscar produtos em estoque LOCAL"]);
    }
}

// Função para buscar todos os produtos em estoque VIRTUAL
function getAllVirtual($pdo)
{

    try {
        $stmt = $pdo->query('SELECT * FROM products WHERE inventory = "VIRTUAL"');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode(["data" => $results]);
    } catch (PDOException $e) {
        return json_encode(["error" => "Erro ao buscar produtos em estoque VIRTUAL"]);
    }
}

// Função para buscar um produto por ID
function getById($pdo, $id)
{

    try {
        $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return json_encode(["data" => $result]);
        } else {
            return json_encode(["error" => "Produto não encontrado"]);
        }
    } catch (PDOException $e) {
        return json_encode(["error" => "Erro ao buscar produto por ID"]);
    }
}

// Função para buscar as categorias dos produtos
function getCategories($pdo)
{

    try {
        $stmt = $pdo->query('SELECT name FROM categories');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode(["data" => $results]);
    } catch (PDOException $e) {
        return json_encode(["error" => "Erro ao buscar as categorias dos produtos"]);
    }
}

function getBrands($pdo)
{

    try {
        $stmt = $pdo->query('SELECT name FROM brands');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode(["data" => $results]);
    } catch (PDOException $e) {
        return json_encode(["error" => "Erro ao buscar as marcas dos produtos"]);
    }
}


// Roteamento de acordo com a rota
switch ($route) {
    case 'all':
        echo getAll($pdo);
        break;
    case 'alllocal':
        echo getAllLocal($pdo);
        break;
    case 'allvirtual':
        echo getAllVirtual($pdo);
        break;
    case 'categories':
        echo getCategories($pdo);
        break;
    case 'brands':
        echo getBrands($pdo);
        break;
    case 'get':
        $productId = isset($_GET['id']) ? $_GET['id'] : null;
        if ($productId !== null) {
            echo getById($pdo, $productId);
        } else {
            echo json_encode(["error" => "ID do produto não fornecido"]);
        }
        break;
    default:
        echo json_encode(["error" => "Rota inválida."]);
}
