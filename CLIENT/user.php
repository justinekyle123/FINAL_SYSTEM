<?php
include 'includes/config.php';
include 'includes/navbar.php';
include 'includes/sidebar.php';

if (!isset($_SESSION['user_id'])) {
    echo"<script>
        window.location.href = 'login.php';
   </script>";
}

$user_id = $_SESSION['user_id'];
$userSql = "SELECT username FROM users WHERE id = $user_id";
$userResult = $conn->query($userSql);
$user = $userResult->fetch_assoc();

$postQuery = "SELECT * FROM admin_post ORDER BY created_at DESC LIMIT 5";
$postResult = $conn->query($postQuery);
?>

<style>
  .dashboard-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    border-radius: 50%;
    margin-bottom: 15px;
  }
  .bg-primary-light { background-color: #e0f0ff; color: #007bff; }
  .bg-success-light { background-color: #e3f7ec; color: #28a745; }
  .bg-warning-light { background-color: #fff3cd; color: #ffc107; }

  .card-title {
    font-weight: 600;
    font-size: 18px;
  }

  .card:hover {
    transform: translateY(-3px);
    transition: all 0.3s ease;
  }

  .section-title {
    font-weight: 700;
    color: #333;
  }
</style>

<div id="main-content">
  <div class="container py-5">

    <!---------------------------- Welcome Section ---------------------->
    <div class="text-center mb-5">
      <h2 class="fw-bold text-primary section-title">Welcome, <?= htmlspecialchars($user['username']) ?>!</h2>
      <p class="lead fst-italic text-muted">“Travel is the only thing you buy that makes you richer.”</p>
    </div>

    <!---------------------------- Action Cards ---------------------->
    <div class="row text-center mb-5">
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100 border-0 p-3">
          <div class="card-body">
            <div class="dashboard-icon bg-primary-light mx-auto">
              <i class="fas fa-map-marked-alt"></i>
            </div>
            <h5 class="card-title">Browse Destinations</h5>
            <p class="text-muted small">Explore amazing places to visit</p>
            <a href="destinations.php" class="btn btn-sm btn-primary mt-2">Explore</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100 border-0 p-3">
          <div class="card-body">
            <div class="dashboard-icon bg-success-light mx-auto">
              <i class="fas fa-suitcase-rolling"></i>
            </div>
            <h5 class="card-title">My Plans</h5>
            <p class="text-muted small">View your saved travel plans</p>
            <a href="plans.php" class="btn btn-sm btn-success mt-2">View Plans</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100 border-0 p-3">
          <div class="card-body">
            <div class="dashboard-icon bg-warning-light mx-auto">
              <i class="fas fa-user-edit"></i>
            </div>
            <h5 class="card-title">Edit Profile</h5>
            <p class="text-muted small">Keep your info up to date</p>
            <a href="edit_profile.php" class="btn btn-sm btn-warning mt-2">Edit</a>
          </div>
        </div>
      </div>
    </div>
