<?php
include_once "includes/config.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
include_once "includes/navbar.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Fetch current password from DB (plain text)
    $result = $conn->query("SELECT password FROM users WHERE id = $user_id");
    $row = $result->fetch_assoc();

    if (!$row || $row['password'] !== $current_password) {
        $error = "Current password is incorrect.";
    } elseif ($new_password !== $confirm_password) {
        $error = "New passwords do not match.";
    } elseif (strlen($new_password) < 6) {
        $error = "New password must be at least 6 characters.";
    } else {
        // Update password in DB (plain text)
        $new_password_escaped = $conn->real_escape_string($new_password);
        $sql = "UPDATE users SET password = '$new_password_escaped' WHERE id = $user_id";
        if ($conn->query($sql) === TRUE) {
            $success = "Password updated successfully!";
        } else {
            $error = "Failed to update password.";
        }
    }
}
?>

<div id="main-content">
    <div class="container mt-5">
        <div class="card shadow-sm p-4 mx-auto" style="max-width: 500px;">
            <h4 class="mb-4 text-center"><i class="fas fa-key me-2"></i>Change Password</h4>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php elseif ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="POST" autocomplete="off">
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-lock me-1"></i> Current Password</label>
                    <input type="password" name="current_password" class="form-control" required minlength="2">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-lock me-1"></i> New Password</label>
                    <input type="password" name="new_password" class="form-control" required minlength="6">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-lock me-1"></i> Confirm New Password</label>
                    <input type="password" name="confirm_password" class="form-control" required minlength="6">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary ">
                        <i class="fas fa-save me-1"></i> Update Password
                    </button>
                    <a href="user_profile.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Cancel</a>
                </div>

                
            </form>
        </div>
    </div>
</div>
