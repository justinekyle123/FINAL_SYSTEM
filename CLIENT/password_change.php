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

    $result = $conn->query("SELECT password FROM users WHERE id = $user_id");
    $row = $result->fetch_assoc();

    if (!$row || $row['password'] !== $current_password) {
        $error = "Current password is incorrect.";
    } elseif ($new_password !== $confirm_password) {
        $error = "New passwords do not match.";
    } elseif (strlen($new_password) < 6) {
        $error = "New password must be at least 6 characters.";
    } else {
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

<style>
    .card-password {
        max-width: 500px;
        margin: auto;
        padding: 30px;
        border-radius: 12px;
        border: none;
    }

    .form-label {
        font-weight: 500;
        color: #333;
    }

    .input-group-text {
        background-color: #f0f0f0;
        border: none;
    }

    input.form-control:focus {
        box-shadow: none;
        border-color: #0d6efd;
    }
</style>

<div id="main-content">
  <div class="container mt-5">
    <div class="card shadow card-password">
      <h4 class="mb-4 text-center text-primary"><i class="fas fa-key me-2"></i>Change Password</h4>

      <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php elseif ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <form method="POST" autocomplete="off">
        <div class="mb-3">
          <label class="form-label">Current Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" name="current_password" class="form-control" required minlength="2">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">New Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock-open"></i></span>
            <input type="password" name="new_password" class="form-control" required minlength="6">
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label">Confirm New Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-check"></i></span>
            <input type="password" name="confirm_password" class="form-control" required minlength="6">
          </div>
        </div>

        <div class="d-flex justify-content-between">
          <a href="user_profile.php" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Cancel
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Update Password
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
