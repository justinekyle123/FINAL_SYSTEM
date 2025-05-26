<?php
include_once "includes/config.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
include_once "includes/navbar.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$userCountResult = $conn->query("SELECT COUNT(*) AS total FROM users");
$userCount = $userCountResult->fetch_assoc()['total'];

$destinationCountResult = $conn->query("SELECT COUNT(*) AS total FROM destination");
$destinationCount = $destinationCountResult->fetch_assoc()['total'];

$adminCountResult = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role = 'admin'");
$adminCount = $adminCountResult->fetch_assoc()['total'];

?>
       
<div id="main-content">
    <div class="container-fluid mt-4">
        <h2 class="mb-4"><i class="fas fa-chart-line me-2"></i>Admin Dashboard</h2>

        <div class="container mt-5">
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card text-bg-primary shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-users me-2"></i>Total Users</h5>
                            <p class="card-text fs-4"><?= $userCount ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-success shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-map-marked-alt me-2"></i>Records</h5>
                            <p class="card-text fs-4"><?= $destinationCount ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-warning shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-user-shield me-2"></i>Admins</h5>
                            <p class="card-text fs-4"><?= $adminCount ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-danger shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-cogs me-2"></i>Settings</h5>
                            <p class="card-text fs-4">✓</p>
                        </div>
                    </div>
                </div>
            </div>


<!-----------------------------TABLE HERE :)------------------------------->

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <i class="fas fa-clock me-2"></i>Recently Added Destinations
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Image</th>
                            <th>Date Added</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $recent = $conn->query("SELECT * FROM destination ORDER BY id DESC LIMIT 5");
                        while ($row = $recent->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['address']) ?></td>
                            <td><?= htmlspecialchars($row['contact_number']) ?></td>
                            <td><img src="uploads/<?= $row['image'] ?>" width="60"></td>
                            <td><?= $row['created_at'] ?? 'N/A' ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
