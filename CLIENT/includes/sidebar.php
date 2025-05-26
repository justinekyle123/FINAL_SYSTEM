<?php
if (!isset($_SESSION)) session_start();
?>

<style>
    /* Sidebar Styles */
    #sidebar {
        width: 250px;
        height: 100vh;
        background-color: #212529;
        position: fixed;
        top: 0;
        left: 0;
        transition: margin-left 0.3s;
        z-index: 1000;
        border-right: 1px solid #2c3034;
    }

    #sidebar.hide {
        margin-left: -250px;
    }

    #sidebar .sidebar-header {
        padding: 20px;
        background-color: #343a40;
        font-size: 1.2rem;
        color: #fff;
        border-bottom: 1px solid #2c3034;
    }

    #sidebar a {
        padding: 15px 20px;
        display: flex;
        align-items: center;
        color: #ccc;
        text-decoration: none;
        border-bottom: 1px solid #2c3034;
        transition: all 0.2s;
    }

    #sidebar a:hover {
        background-color: #495057;
        color: #fff;
    }

    #sidebar i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    #main-content {
        margin-left: 250px;
        transition: margin-left 0.3s;
        padding: 20px;
    }

    #main-content.full {
        margin-left: 0;
    }

    .toggle-btn {
        position: fixed;
        left: 10px;
        top: 10px;
        z-index: 1100;
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


<button class="btn btn-dark toggle-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

<!---------------------------------------SIDE BAR--------------------------->
<div id="sidebar" class="collapsed">
    <div class="sidebar-header">
       <div class="d-flex align-items-center ms-auto text-light">
        <i class="fas fa-user-circle fs-4 ms-5"></i>
      <div class="d-flex flex-column me-5">
        <span class="fw-semibold ms-1"><?= htmlspecialchars($_SESSION['username']) ?></span>
      </div>
    </div>
    </div>


    <?php if ($_SESSION['role'] === 'admin'): ?>
    <a href="admin.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="manage_users.php"><i class="fas fa-users-cog"></i> Manage Users</a>
    <a href="add_destination.php"><i class="fas fa-plus-circle"></i> Add Destination</a>
    <a href="manage_destinations.php"><i class="fas fa-map-marked-alt"></i> Manage Destinations</a>
    <a href="add_post.php"><i class="fas fa-bullhorn"></i> Post Announcement</a>
    <a href="admin_post.php"><i class="fas fa-bullhorn"></i> View Announcements</a>
    <a href="admin_feedback.php"><i class="fas fa-comments"></i> User Feedback</a>
<?php elseif ($_SESSION['role'] === 'user'): ?>
    <a href="user.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="user_profile.php"><i class="fas fa-user"></i> My Profile</a>
    <a href="destinations.php"><i class="fas fa-map"></i> View Destinations</a>
    <a href="plans.php"><i class="fas fa-map"></i> Plans</a>
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
