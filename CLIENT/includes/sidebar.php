<?php
if (!isset($_SESSION)) 
session_start();
?>

<style>
  /* Sidebar Base */
  #sidebar {
    width: 250px;
    height: 100vh;
    background: linear-gradient(180deg, #212529, #343a40);
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
    transition: all 0.3s ease;
    z-index: 1000;
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.2);
  }

  #sidebar.hide {
    margin-left: -250px;
  }

  /* Sidebar Header */
  .sidebar-header {
    padding: 20px;
    background-color: #1c1f23;
    color: #fff;
    text-align: center;
    border-bottom: 1px solid #2c3034;
  }

  .sidebar-header i {
    font-size: 2rem;
    margin-bottom: 10px;
  }

  .sidebar-header span {
    display: block;
    font-weight: bold;
    font-size: 1rem;
  }

  /* Sidebar Links */
  #sidebar a {
    display: flex;
    align-items: center;
    padding: 14px 20px;
    color: #dcdcdc;
    text-decoration: none;
    font-size: 15px;
    transition: background-color 0.2s ease;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
  }

  #sidebar a:hover {
    background-color: #495057;
    color: #ffffff;
  }

  #sidebar a i {
    margin-right: 10px;
    font-size: 16px;
    width: 20px;
    text-align: center;
  }

  /* Toggle Button */
  .toggle-btn {
    position: fixed;
    left: 15px;
    top: 15px;
    z-index: 1100;
  }

  #main-content {
    margin-left: 250px;
    transition: all 0.3s ease;
    padding: 20px;
  }

  #main-content.full {
    margin-left: 0;
  }


  @media (max-width: 768px) {
    #sidebar {
      margin-left: -250px;
    }

    #sidebar.show {
      margin-left: 0;
    }

    #main-content {
      margin-left: 0;
    }
  }
</style>

<button class="btn btn-outline-light toggle-btn" onclick="toggleSidebar()">
  <i class="fas fa-bars"></i>
</button>

<div id="sidebar">
  <div class="sidebar-header">
    <i class="fas fa-user-circle"></i>
    <span><?= htmlspecialchars($_SESSION['username']) ?></span>
  </div>

  <?php if ($_SESSION['role'] === 'admin'): ?>
    <a href="admin.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="manage_users.php"><i class="fas fa-users-cog"></i> Manage Users</a>
    <a href="add_destination.php"><i class="fas fa-plus-circle"></i> Add Destination</a>
    <a href="manage_destinations.php"><i class="fas fa-map-marked-alt"></i> Manage Destinations</a>
    <a href="activity_logs.php"><i class="fas fa-history"></i> Activity Logs</a>
    <a href="admin_feedback.php"><i class="fas fa-comments"></i> User Feedback</a>
  <?php elseif ($_SESSION['role'] === 'user'): ?>
    <a href="user.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="user_profile.php"><i class="fas fa-user"></i> My Profile</a>
    <a href="destinations.php"><i class="fas fa-map"></i> View Destinations</a>
    <a href="plans.php"><i class="fas fa-map"></i>My Plans</a>
    <a href="feedback.php"><i class="fas fa-comment-dots"></i> Send Feedback</a>
  <?php endif; ?>

  <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<script>
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main-content');
    sidebar.classList.toggle('hide');
    main.classList.toggle('full');
  }
</script>
