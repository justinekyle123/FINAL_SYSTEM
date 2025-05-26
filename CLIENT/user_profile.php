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

?>

<div id="main-content">
  <div class="container mt-5">
    <div class="card shadow border-0 p-4 bg-light">
      <div class="row align-items-center">
        <!-- Profile Image & Username -->
        <div class="col-md-4 text-center mb-4 mb-md-0">
          <img src="uploads/profile.png" class="rounded-circle shadow-sm mb-3" width="140" height="140" alt="Profile Image">
          <h5 class="mb-0 text-primary"><?= htmlspecialchars($user['username']) ?></h5>
          <span class="text-muted text-capitalize small"><i class="fas fa-user-tag me-1"></i><?= htmlspecialchars($user['role']) ?></span>
        </div>

        <!-- Profile Details -->
        <div class="col-md-8">
          <h4 class="mb-3 text-dark"><i class="fas fa-user-circle me-2 text-primary"></i>Profile Details</h4>
          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-light">
              <i class="fas fa-envelope text-secondary me-2"></i><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?>
            </li>
            <li class="list-group-item bg-light">
              <i class="fas fa-phone text-secondary me-2"></i><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?>
            </li>
            <li class="list-group-item bg-light">
              <i class="fas fa-map-marker-alt text-secondary me-2"></i><strong>Address:</strong> <?= htmlspecialchars($user['address']) ?>
            </li>
          </ul>

          <!-- Action Buttons -->
          <div class="mt-4 d-flex gap-2 flex-wrap">
            <a href="edit_profile.php" class="btn btn-primary">
              <i class="fas fa-edit me-1"></i>Edit Profile
            </a>
            <a href="password_change.php" class="btn btn-outline-dark">
              <i class="fas fa-key me-1"></i>Change Password
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
