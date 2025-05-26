<?php
    include_once "includes/config.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Confirm the user exists (optional but safe)
    $check = $conn->query("SELECT * FROM users WHERE id = $id");
    if ($check->num_rows > 0) {
        // Proceed with delete
        $conn->query("DELETE FROM users WHERE id = $id");

        $_SESSION['deleted'] = true;
    }
}

header("Location: manage_users.php");
exit;
