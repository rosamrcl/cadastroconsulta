<?php

header("Content-Type: application/json");

$ambFile = 'api/product.json';

// Função para ler os produtos
function readProduct() {
    global $ambFile;
    if (file_exists($ambFile)) {
        $json = file_get_contents($ambFile);
        return json_decode($json, true) ?: []; // Retorna array vazio em caso de erro no decode
    }
    return [];
}

// Função para salvar os produtos
function saveProduct($products) {
    global $ambFile;
    file_put_contents($ambFile, json_encode($products, JSON_PRETTY_PRINT));
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $products = readProduct();
        if (!empty($products)) {
            http_response_code(200);
            echo json_encode(array(
                "success" => true,
                "data" => $products
            ));
        } else {
            http_response_code(404);
            echo json_encode(array(
                "success" => false,
                "message" => "Nenhum produto cadastrado."
            ));
        }
        break;

    case 'POST':
        $newProductData = json_decode(file_get_contents("php://input"), true);

        if (!isset($newProductData['name']) || !isset($newProductData['price']) || !isset($newProductData['amount'])) {
            http_response_code(400);
            echo json_encode(array(
                "success" => false,
                "message" => "Dados incompletos. Nome, preço e quantidade são obrigatórios."
            ));
            break;
        }

        $newProduct = array(
            "id" => uniqid(),
            "name" => htmlspecialchars(strip_tags($newProductData['name'])),
            "descricao" => isset($newProductData['descricao']) ? htmlspecialchars(strip_tags($newProductData['descricao'])) : null,
            "preco" => floatval($newProductData['price']),
            "quantidade" => intval($newProductData['amount']),
            "data_criacao" => date('Y-m-d H:i:s')
        );

        $products = readProduct();
        $products[] = $newProduct;

        if (saveProduct($products)) {
            http_response_code(201);
            echo json_encode(array(
                "success" => true,
                "message" => "Produto criado com sucesso.",
                "data" => $newProduct
            ));
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(array(
                "success" => false,
                "message" => "Erro ao salvar o produto."
            ));
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(array(
            "success" => false,
            "message" => "Método não permitido."
        ));
}

?>