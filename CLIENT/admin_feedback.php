<?php
include 'includes/config.php';
include 'includes/navbar.php';
include 'includes/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$sql = "SELECT f.*, u.username FROM feedback f 
        JOIN users u ON f.user_id = u.id 
        ORDER BY f.created_at DESC";
$result = $conn->query($sql);
?>

<div id="main-content">
  <div class="container py-5">
    <h2><i class="fas fa-comments me-2"></i>User Feedback</h2>

    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card mb-3 shadow-sm">
          <div class="card-body">
            <h6 class="card-title"><i class="fas fa-user me-1"></i><?= htmlspecialchars($row['username']) ?></h6>
            <p class="card-text"><?= nl2br(htmlspecialchars($row['message'])) ?></p>
            <p class="text-muted small"><i class="fas fa-clock me-1"></i><?= date('F j, Y - h:i A', strtotime($row['created_at'])) ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="alert alert-info">No feedbacks yet.</div>
    <?php endif; ?>
  </div>
</div>
