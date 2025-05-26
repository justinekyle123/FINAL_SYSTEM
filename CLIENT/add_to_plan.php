<?php
include 'includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int) $_SESSION['user_id'];
$destination_id = (int) $_POST['id'];

$checkDestination = $conn->query("SELECT id FROM destination WHERE id = $destination_id");
if ($checkDestination->num_rows == 0) {
    die("Destination does not exist.");
}

// Check if already in plan
$check = $conn->query("SELECT * FROM plan WHERE user_id = $user_id AND destination_id = $destination_id");
if ($check->num_rows > 0) {
    header("Location: plans.php?exists=1");
    exit;
}

// Try insert
if ($conn->query("INSERT INTO plan (user_id, destination_id) VALUES ($user_id, $destination_id)")) {
    header("Location: plans.php?added=1");
} else {
    die("Error inserting into plan: " . $conn->error);
}
