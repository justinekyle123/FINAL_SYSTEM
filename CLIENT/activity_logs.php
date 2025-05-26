<?php
include 'includes/config.php';
include 'includes/navbar.php';
include 'includes/sidebar.php';

$sql = "SELECT a.*, u.username FROM activity_log a JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC";
$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}

?>

<div id="main-content">
  <div class="container py-5">
    <h2><i class="fas fa-history me-2"></i>Activity Logs</h2>
    <div class="table-responsive mt-4">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>User</th>
            <th>Activity</th>
            <th>Date/Time</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['username']) ?></td>
              <td><?= htmlspecialchars($row['activity']) ?></td>
              <td><?= date('F j, Y g:i A', strtotime($row['created_at'])) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
