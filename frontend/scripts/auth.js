document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    fetch("http://localhost/smart-inventory/backend/auth/login.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ username, password }) // Correct encoding
    })
    .then(res => res.json()) // Ensure response is parsed as JSON
    .then(data => {
        if (data.message) {
            alert(data.message);
            window.location.href = "dashboard.php";
        } else if (data.error) {
            alert("Invalid credentials: " + data.error);
            console.log("Error:", data.error);
        } else {
            alert("Unexpected response from server.");
            console.log("Unexpected:", data);
        }
    })
    .catch(error => {
        alert("Login request failed.");
        console.error("Fetch Error:", error);
    });
});
