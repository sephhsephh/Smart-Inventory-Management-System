<?php
require_once __DIR__ . '/../config/database.php';

class Product {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProduct($name, $sku, $quantity, $price) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, sku, quantity, price) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $sku, $quantity, $price]);
    }

    public function updateProduct($id, $name, $sku, $quantity, $price) {
        $stmt = $this->conn->prepare("UPDATE products SET name=?, sku=?, quantity=?, price=? WHERE id=?");
        return $stmt->execute([$name, $sku, $quantity, $price, $id]);
    }

    public function deleteProduct($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>
