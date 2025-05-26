<?php
include_once "includes/config.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
include_once "includes/navbar.php";


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result = $conn->query("SELECT * FROM destination WHERE id = $id");

if ($result->num_rows === 0) {
    echo "<script>alert('Destination not found!'); window.location.href='manage_destination.php';</script>";
    exit;
}

$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $contact = $conn->real_escape_string($_POST['contact_number']);

    if (!empty($_FILES['image']['name'])) {
        $imageName = basename($_FILES['image']['name']);
        $targetPath = "uploads/" . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
    } else {
        $imageName = $data['image'];
    }

    $sql = "UPDATE destination SET name='$name', address='$address', contact_number='$contact', image='$imageName' WHERE id=$id";

    if ($conn->query($sql)) {
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Updated successfully!',
            showConfirmButton: true,
        }).then(() => {
            window.location.href = 'manage_destinations.php';
        });
        </script>";
        exit;
    } else {
        echo "
        <script>
        Swal.fire('Error', 'Failed to update destination.', 'error');
        </script>";
    }
}
?>

<div id="main-content">
    <div class="container">
    <h3>Edit Destination</h3>
    <form method="post" enctype="multipart/form-data" id="editForm">
        <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
        <label>Address</label>
        <input type="text" name="address" value="<?= htmlspecialchars($data['address']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
        <label>Contact</label>
        <input type="text" name="contact_number" value="<?= htmlspecialchars($data['contact_number']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
        <label>Current Image</label><br>
        <img src="uploads/<?= $data['image'] ?>" width="100"><br><br>
        <label>Change Image</label>
        <input type="file" name="image" class="form-control">
        </div>

        <button type="button" class="btn btn-primary" onclick="confirmUpdate()">
             <i class="fas fa-save"></i> Save Changes
        </button>
        <a href="manage_destinations.php" class="btn btn-secondary">Cancel</a>
    </form>
    </div>
</div>

<script>
function confirmUpdate() {
  Swal.fire({
    title: 'Update this destination?',
    text: 'Are you sure you want to apply the changes?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Yes, update it',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('editForm').submit();
    }
  });
}
</script>