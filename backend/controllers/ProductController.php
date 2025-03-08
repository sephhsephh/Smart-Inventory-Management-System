<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../config/database.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$productModel = new Product($conn);
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    echo json_encode($productModel->getAllProducts());
} elseif ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if ($productModel->addProduct($data['name'], $data['sku'], $data['quantity'], $data['price'])) {
        echo json_encode(["message" => "Product added successfully"]);
    } else {
        echo json_encode(["error" => "Failed to add product"]);
    }
} elseif ($method === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    if ($productModel->updateProduct($data['id'], $data['name'], $data['sku'], $data['quantity'], $data['price'])) {
        echo json_encode(["message" => "Product updated successfully"]);
    } else {
        echo json_encode(["error" => "Failed to update product"]);
    }
} elseif ($method === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    if ($productModel->deleteProduct($data['id'])) {
        echo json_encode(["message" => "Product deleted successfully"]);
    } else {
        echo json_encode(["error" => "Failed to delete product"]);
    }
}
?>
