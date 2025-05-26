  <?php
include_once "includes/config.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
include_once "includes/navbar.php";

$limit = 5; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$where = $search ? "WHERE username LIKE '%$search%' OR email LIKE '%$search%'" : '';


$total_result = $conn->query("SELECT COUNT(*) as total FROM users $where");
$total_users = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_users / $limit);

$sql = "SELECT * FROM users $where ORDER BY id ASC LIMIT $start, $limit";
$result = $conn->query($sql);

?>

<div id="main-content">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="fas fa-users me-2"></i>Manage Users</h2>
            <form method="get" class="d-flex" role="search">
                <input type="text" name="search" class="form-control me-2" placeholder="Search username/email" value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm rounded ">
            <thead class="table-dark text-center">
        <tr>
            <th>ID</th><th>Username</th><th>Email</th>
            <th>Role</th><th>Phone</th><th>Address</th><th>Actions</th>
        </tr>
    </thead>
    <tbody class="text-center align-middle">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><span class="badge bg-<?= $row['role'] === 'admin' ? 'success' : 'secondary' ?>"><?= $row['role'] ?></span></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td>
                        <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-sm btn-outline-danger delete-btn" data-id="<?= $row['id'] ?>">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="8">No users found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
        </div>

        <!---------------------------TO CHANGE THE PAGE--------------------------------------->
    
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                    <li class="page-item <?= $p == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $p ?>&search=<?= urlencode($search) ?>"><?= $p ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>

<!------------------------------THIS IS THE MESSAGES WITH EFFECTS :)    ----------------------------------------->

<script>
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function () {
        const userId = this.getAttribute('data-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `delete_user.php?id=${userId}`;
            }
        });
    });
});
</script>      
</body>
</html>