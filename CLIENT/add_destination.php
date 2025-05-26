<?php
include_once "includes/config.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
include_once "includes/navbar.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $contact = $_POST['contact_number'];

    $image = time() . '_' . $_FILES['image']['name'];
    $target = "uploads/" . $image;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO destination (name, description, address, contact_number, image)
                VALUES ('$name', '$description', '$address', '$contact', '$image')";

        if ($conn->query($sql)) {
            echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Destination Added!',
                    text: 'The new destination was successfully added.',
                    showConfirmButton: true,
                });
                setTimeout(function() {
                    window.location.href = 'manage_destinations.php';
                }, 2000);
            </script>";
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire('Error', 'Something went wrong with the database.', 'error');
            </script>";
        }
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire('Upload Failed', 'Image could not be uploaded.', 'error');
        </script>";
    }
}
?>

<style>
    .card-modern {
        border-radius: 1rem;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }

    .form-label {
        font-weight: 500;
    }

    .input-group-text {
        background-color: #f0f0f0;
        border: none;
    }

    input.form-control, textarea.form-control {
        border-radius: 0.5rem;
    }

    .btn-success {
        border-radius: 0.5rem;
        padding: 0.5rem 1.25rem;
    }
</style>

<div id="main-content">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <div class="card card-modern border-0">
          <div class="card-header bg-success text-white rounded-top">
            <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Add New Destination</h5>
          </div>

          <div class="card-body bg-white p-4">
            <form method="POST" enctype="multipart/form-data" id="destinationForm">

              <div class="mb-3">
                <label class="form-label">Destination Name</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-tag"></i></span>
                  <input type="text" name="name" class="form-control" placeholder="e.g. Boracay Island" required>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Description</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                  <textarea name="description" class="form-control" rows="3" placeholder="Brief description of the destination" required></textarea>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Address</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                  <input type="text" name="address" class="form-control" placeholder="Complete address" required>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Contact Number</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  <input type="text" name="contact_number" class="form-control" placeholder="e.g. 09123456789" required>
                </div>
              </div>

              <div class="mb-4">
                <label class="form-label">Upload Image</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-image"></i></span>
                  <input type="file" name="image" class="form-control" required>
                </div>
              </div>

              <div class="text-end">
                <button type="button" onclick="confirmInsert()" class="btn btn-success">
                  <i class="fas fa-plus me-1"></i> Add Destination
                </button>
              </div>

            </form>
          </div>

          <div class="card-footer text-center text-muted small">
            Please fill out all required fields before submitting.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function confirmInsert() {
  Swal.fire({
    title: 'Confirm submission',
    text: 'Are you sure you want to add this destination?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Yes, submit it!',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('destinationForm').submit();
    }
  });
}
</script>
