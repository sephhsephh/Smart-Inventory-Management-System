<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>

<body>
    <div class="container">
        <div class="welcome-message">
            <img src="../assets/images/Logo_BLUEGRAY_WHITEBG.png" alt="Logo">
            <h1>Welcome To Sephh's Smart Inventory Management System!</h1>
            <p>Please enter your details.</p>
        </div>
        <div class="login-panel">
            <form id="loginForm">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Username" required>
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Password" required>
                <div class="form-options">
                    <label>
                        <input type="checkbox" id="remember"> Remember for 30 days
                    </label>
                    <a href="#">Forgot password</a>
                </div>
                <button type="submit">Sign in</button>
                <p>Don't have an account? <a href="#">Contact Owner</a></p>
            </form>
        </div>
    </div>
    <script src="../scripts/auth.js"></script>
</body>

</html>