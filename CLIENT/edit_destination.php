<?php
include_once "includes/config.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
include_once "includes/navbar.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result = $conn->query("SELECT * FROM destination WHERE id = $id");

if ($result->num_rows === 0) {
    echo "<script>alert('Destination not found!'); window.location.href='manage_destinations.php';</script>";
    exit;
}

$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $contact = $conn->real_escape_string($_POST['contact_number']);

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = "uploads/" . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
    } else {
        $imageName = $data['image'];
    }

    $sql = "UPDATE destination SET name='$name', address='$address', contact_number='$contact', image='$imageName' WHERE id=$id";

    if ($conn->query($sql)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
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
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire('Error', 'Failed to update destination.', 'error');
        </script>";
    }
}
?>

<style>
.card-modern {
    border-radius: 1rem;
    box-shadow: 0 0 20px rgba(0,0,0,0.06);
}
.img-preview {
    width: 100%;
    max-width: 200px;
    height: auto;
    border-radius: 0.5rem;
    border: 1px solid #ccc;
    display: block;
    margin-top: 5px;
}
</style>

<div id="main-content">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-xl-9">
        <div class="card card-modern border-0">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Destination</h5>
          </div>

          <div class="card-body bg-white p-4">
            <form method="post" enctype="multipart/form-data" id="editForm">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Destination Name</label>
                  <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" class="form-control" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Address</label>
                  <input type="text" name="address" value="<?= htmlspecialchars($data['address']) ?>" class="form-control" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Contact Number</label>
                  <input type="text" name="contact_number" value="<?= htmlspecialchars($data['contact_number']) ?>" class="form-control" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Current Image</label><br>
                  <img src="uploads/<?= htmlspecialchars($data['image']) ?>" class="img-preview">
                </div>

                <div class="col-md-12">
                  <label class="form-label">Change Image</label>
                  <input type="file" name="image" class="form-control">
                </div>
              </div>

              <div class="d-flex justify-content-between mt-4">
                <a href="manage_destinations.php" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Cancel
                </a>
                <button type="button" class="btn btn-primary" onclick="confirmUpdate()">
                  <i class="fas fa-save me-1"></i> Save Changes
                </button>
              </div>
            </form>
          </div>

          <div class="card-footer text-center text-muted small">
            Make sure all details are correct before saving.
          </div>
        </div>
      </div>
    </div>
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
