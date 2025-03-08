<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles/dashboard.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['role'])) {
        $_SESSION['role'] = 'INTRUDER'; // Default role if not set
    }
    ?>
    <div class="sidenav">
        <h1><?php echo $_SESSION['role']; ?></h1>
        <a href="inventory.php">Inventory</a>
    </div>
    <div class="main-content">
        <!-- Main content goes here -->
    </div>
</body>

</html>