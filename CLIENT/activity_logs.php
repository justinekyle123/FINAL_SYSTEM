<?php
include 'includes/config.php';
include 'includes/navbar.php';
include 'includes/sidebar.php';

$limit = 10; 
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$totalSql = "SELECT COUNT(*) AS total FROM activity_log";
$totalResult = $conn->query($totalSql);
$totalRows = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

$sql = "SELECT a.*, u.username FROM activity_log a JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}
?>

<div id="main-content">
  <div class="container py-5">
    <h2 class="mb-4"><i class="fas fa-history me-2"></i>Activity Logs</h2>

    <div class="table-responsive shadow rounded">
      <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>User</th>
            <th>Activity</th>
            <th>Date/Time</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['activity']) ?></td>
                <td><?= date('F j, Y g:i A', strtotime($row['created_at'])) ?></td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="3" class="text-center text-muted">No activity logs found.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  
    <?php if ($totalPages > 1): ?>
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center mt-4">
         
          <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page - 1 ?>" tabindex="-1" aria-disabled="<?= ($page <= 1) ? 'true' : 'false' ?>">Previous</a>
          </li>

          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
              <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>

          <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
          </li>
        </ul>
      </nav>
    <?php endif; ?>
  </div>
</div>
