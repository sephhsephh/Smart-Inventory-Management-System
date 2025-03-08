console.log("Inventory script loaded");

document.addEventListener("DOMContentLoaded", function () {
    checkSession(); // First, check if the user is logged in
    loadInventory(); // Fetch inventory data

    document
        .getElementById("productForm")
        .addEventListener("submit", function (e) {
            e.preventDefault();
            saveProduct();
        });
});

// Fetch inventory data
function loadInventory() {
    fetch("http://localhost/smart-inventory/backend/routes/api.php")
        .then((response) => response.json())
        .then((data) => {
            let tableBody = document.querySelector("#inventoryTable tbody");
            tableBody.innerHTML = ""; // Clear old data
            data.forEach((product) => {
                let row = document.createElement("tr");
                row.innerHTML = `
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.sku}</td>
                    <td>${product.quantity}</td>
                    <td>$${product.price}</td>
                    <td>
                        <button onclick="editProduct(${product.id}, '${product.name}', '${product.sku}', ${product.quantity}, ${product.price})">Edit</button>
                        <button onclick="deleteProduct(${product.id})">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch((error) => console.error("Error fetching inventory:", error));
}

// Save or update a product
function saveProduct() {
    let id = document.getElementById("productId").value;
    let name = document.getElementById("name").value;
    let sku = document.getElementById("sku").value;
    let quantity = document.getElementById("quantity").value;
    let price = document.getElementById("price").value;

    let url = "http://localhost/smart-inventory/backend/routes/api.php";
    let method = id ? "PUT" : "POST";
    let data = { id, name, sku, quantity, price };

    fetch(url, {
        method: method,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
    })
        .then((response) => response.json())
        .then(() => {
            document.getElementById("productForm").reset();
            loadInventory();
        })
        .catch((error) => console.error("Error saving product:", error));
}

// Populate form for editing
function editProduct(id, name, sku, quantity, price) {
    document.getElementById("productId").value = id;
    document.getElementById("name").value = name;
    document.getElementById("sku").value = sku;
    document.getElementById("quantity").value = quantity;
    document.getElementById("price").value = price;
}

// Delete a product
function deleteProduct(id) {
    if (!confirm("Are you sure?")) return;

    fetch("http://localhost/smart-inventory/backend/routes/api.php", {
        method: "DELETE",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id }),
    })
        .then((response) => response.json())
        .then(() => loadInventory())
        .catch((error) => console.error("Error deleting product:", error));
}

// Check if the user session is valid
function checkSession() {
    fetch("http://localhost/smart-inventory/backend/auth/session.php")
        .then((res) => {
            if (!res.ok) {
                throw new Error("Network response was not ok");
            }
            return res.json(); // Get response as JSON
        })
        .then((data) => {
            if (data.error) {
                window.location.href = "login.php"; // Redirect if not logged in
            } else {
                console.log("User is authenticated:", data);
            }
        })
        .catch((error) => console.error("Error checking session:", error));
}
