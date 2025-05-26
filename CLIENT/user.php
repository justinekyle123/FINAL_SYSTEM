<?php
include 'includes/config.php';
include 'includes/navbar.php';
include 'includes/sidebar.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$userSql = "SELECT username FROM users WHERE id = $user_id";
$userResult = $conn->query($userSql);
$user = $userResult->fetch_assoc();


$postQuery = "SELECT * FROM admin_post ORDER BY created_at DESC LIMIT 5";
$postResult = $conn->query($postQuery);
?>


<div id="main-content">
  <div class="container py-5">

    <!---------------------------- Welcome Section ---------------------->
    <div class="text-center mb-5">
      <h2 class="fw-bold text-primary">Welcome, <?= htmlspecialchars($user['username']) ?>!</h2>
      <p class="lead fst-italic text-secondary">“Travel is the only thing you buy that makes you richer.”</p>
    </div>

    <div class="row text-center mb-4">
  <div class="col-md-4 mb-3">
    <div class="card shadow-sm h-100 border-0">
      <div class="card-body">
        <i class="fas fa-map-marked-alt fa-2x text-primary mb-3"></i>
        <h5 class="card-title">Browse Destinations</h5>
        <a href="destinations.php" class="btn btn-outline-primary btn-sm mt-2">Explore</a>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-3">
    <div class="card shadow-sm h-100 border-0">
      <div class="card-body">
        <i class="fas fa-suitcase-rolling fa-2x text-success mb-3"></i>
        <h5 class="card-title">My Plans</h5>
        <a href="plans.php" class="btn btn-outline-success btn-sm mt-2">View Plans</a>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-3">
    <div class="card shadow-sm h-100 border-0">
      <div class="card-body">
        <i class="fas fa-user-edit fa-2x text-warning mb-3"></i>
        <h5 class="card-title">Edit Profile</h5>
        <a href="edit_profile.php" class="btn btn-outline-warning btn-sm mt-2">Edit</a>
      </div>
    </div>
  </div>
</div>

  