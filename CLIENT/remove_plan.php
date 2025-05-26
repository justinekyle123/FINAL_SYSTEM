<?php
include 'includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$destination_id = isset($_POST['destination_id']) ? (int)$_POST['destination_id'] : 0;

if ($destination_id > 0) {
    $sql = "DELETE FROM plan WHERE user_id = $user_id AND destination_id = $destination_id";
    if ($conn->query($sql)) {
        header("Location: plans.php");
        exit;
    } else {
        echo "Error removing plan: " . $conn->error;
    }
} else {
    echo "Invalid destination ID.";
}
?>
