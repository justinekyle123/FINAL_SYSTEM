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
        $_SESSION['username'] = $username; // update session
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Profile Updated',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = 'user_profile.php';
            });
        </script>";
    } else {
        echo "<div class='alert alert-danger'>Failed to update profile.</div>";
    }
}
?>

<div id="main-content">
  <div class="container mt-5">
    <div class="card shadow-sm p-4">
      <h4 class="mb-4"><i class="fas fa-user-edit me-2"></i>Edit Profile</h4>
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Address</label>
          <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($user['address']) ?>">
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Changes</button>
        <a href="user_profile.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Cancel</a>
      </form>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
