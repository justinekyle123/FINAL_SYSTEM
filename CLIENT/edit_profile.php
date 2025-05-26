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
$result = $conn->query("SELECT * FROM users WHERE id = $user_id");
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['phone']);
    $address  = trim($_POST['address']);

    $sql = "UPDATE users SET 
                username = '$username', 
                email = '$email', 
                phone = '$phone', 
                address = '$address' 
            WHERE id = $user_id";

    if ($conn->query($sql)) {
        $_SESSION['username'] = $username;
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Profile Updated Successfully!',
                showConfirmButton: true,
            }).then(() => {
                window.location.href = 'user_profile.php';
            });
        </script>";
    } else {
        echo "<div class='alert alert-danger'>Failed to update profile.</div>";
    }
}
?>

<style>
    .card-profile {
        max-width: 600px;
        margin: auto;
        border-radius: 12px;
        padding: 30px;
        border: none;
    }

    .form-label {
        font-weight: 500;
        color: #333;
    }

    input.form-control:focus {
        box-shadow: none;
        border-color: #0d6efd;
    }

    .input-group-text {
        background-color: #f0f0f0;
        border: none;
    }

    h4 i {
        color: #0d6efd;
    }
</style>

<div id="main-content">
  <div class="container mt-5">
    <div class="card shadow card-profile">
      <h4 class="mb-4 text-center"><i class="fas fa-user-edit me-2"></i>Edit Profile</h4>

      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Phone</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-phone"></i></span>
            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>">
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label">Address</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
            <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($user['address']) ?>">
          </div>
        </div>

        <div class="d-flex justify-content-between">
          <a href="user_profile.php" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Cancel
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
