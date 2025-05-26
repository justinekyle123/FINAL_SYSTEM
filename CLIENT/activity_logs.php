<?php
include 'includes/config.php';
include 'includes/navbar.php';
include 'includes/sidebar.php';

$sql = "SELECT activity_log.*, users.username 
        FROM activity_log 
        JOIN users ON activity_log.user_id = users.id 
        ORDER BY activity_log.created_at DESC";

$result = $conn->query($sql);
?>

<div id="main-content">
  <div class="container py-5">
    <h2><i class="fas fa-history me-2"></i>Activity Logs</h2>
    <div class="list-group">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="list-group-item">
          <strong><?= htmlspecialchars($row['username']) ?></strong> - 
          <?= htmlspecialchars($row['activity']) ?>
          <span class="text-muted small float-end"><?= date("F j, Y, g:i a", strtotime($row['created_at'])) ?></span>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
