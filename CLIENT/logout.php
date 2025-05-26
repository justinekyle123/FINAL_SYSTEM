<?php

include 'includes/config.php';
include 'includes/functions.php';

if (isset($_SESSION['user_id'])) {
    logActivity($conn, $_SESSION['user_id'], "Logged out");
    session_destroy();
    header("Location: login.php");
    exit;
}
?>