<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

// Return user data or a success message when authenticated
echo json_encode(["success" => "Authorized", "user_id" => $_SESSION['user_id']]);
