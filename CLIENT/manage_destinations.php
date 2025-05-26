<?php

include_once "includes/config.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
include_once "includes/navbar.php";


$limit = 5; 
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$total_query = $conn->query("SELECT COUNT(*) as total FROM destination"); 
$total_row = $total_query->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

$sql = "SELECT * FROM destination ORDER BY id ASC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<div id="main-content">
    <div class="container">
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['contact']) ?></td>
                    <td><img src="uploads/<?= $row['image'] ?>" width="80" height="50"></td>
                    <td>
                        <a href="#" onclick="confirmEdit(<?= $row['id'] ?>)" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="delete_destination.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirmDelete(event)"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<nav>
  <ul class="pagination justify-content-center">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>


<script>
function confirmDelete(e) {
    e.preventDefault();
    const url = e.currentTarget.getAttribute('href');
    Swal.fire({
        title: 'Are you sure?',
        text: "This will permanently delete the destination.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>

<script>
function confirmEdit(id) {
  Swal.fire({
    title: 'Edit this destination?',
    text: 'You are about to edit the details.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, edit it!',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'edit_destination.php?id=' + id;
    }
  });
}
</script>