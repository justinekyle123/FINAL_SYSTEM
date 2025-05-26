<?php
include_once "includes/config.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
// include_once "includes/navbar.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit;
}

$id = (int) $_GET['id'];


$user = $conn->query("SELECT * FROM users WHERE id = $id")->fetch_assoc();
if (!$user) {
    echo "User not found.";
    exit;
}

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $role     = $_POST['role'];
    $phone    = $_POST['phone'];
    $address  = $_POST['address'];

    $sql = "UPDATE users SET 
            username='$username', 
            email='$email',  
            role='$role',
            phone='$phone',
            address='$address' 
            WHERE id=$id";

    if ($conn->query($sql)) {
         echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Updated successfully!',
            showConfirmButton: true,
        }).then(() => {
            window.location.href = 'manage_users.php';
        });
        </script>";
        exit;
    } else {
        $error = "Failed to update user.";
    }
}

?>

<div id="main-content">
    <div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white">
            <h4><i class="fas fa-user-edit me-2"></i>Edit User</h4>
        </div>
        <div class="card-body">

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post" id="editUserForm">
                <input type="hidden" name="update" value="1" />

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required value="<?= htmlspecialchars($user['username']) ?>" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($user['email']) ?>" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($user['address']) ?>" />
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="manage_users.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                    <button type="button" id="confirmUpdate" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Update User
                    </button>
                </div>
            </form>

        </div>
    </div>
    </div>
</div>   

<script>
document.getElementById('confirmUpdate').addEventListener('click', function () {
    Swal.fire({
        title: 'Confirm Update',
        text: "Are you sure you want to update this user?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('editUserForm').submit();
        }
    });
});
</script>

</body>
</html>
