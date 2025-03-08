<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
// echo "User ID: " . htmlspecialchars($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Inventory</title>
    <script src="../scripts/inventory.js" defer></script>
    <script>
        function logout() {
            console.log("Logout function triggered");
            fetch("http://localhost/smart-inventory/backend/auth/logout.php")
                .then(res => res.json())
                .then(data => {
                    console.log("Logout response:", data);
                    window.location.href = "login.php"; // Redirect to login page after logout
                })
                .catch(error => console.error("Logout failed:", error));
        }
    </script>
</head>

<body>
    <h1><?php echo $_SESSION["role"] ?></h1>
    <h1>Inventory Management</h1>

    <!-- Form for Adding & Updating Products -->
    <form id="productForm">
        <input type="hidden" id="productId">
        <input type="text" id="name" placeholder="Product Name" required>
        <input type="text" id="sku" placeholder="SKU" required>
        <input type="number" id="quantity" placeholder="Quantity" required>
        <input type="number" step="0.01" id="price" placeholder="Price" required>
        <button type="submit">Save Product</button>
    </form>

    <!-- Inventory Table -->
    <table id="inventoryTable" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <button onclick="logout()">Logout</button>
</body>

</html>