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
  body, html {
    overflow-x: hidden;
  }

  #main-content {
    padding: 40px;
    max-width: 100%;
  }

  .form-section {
    background-color: #fff;
    padding: 30px;
    border-radius: 1rem;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .form-label {
    font-weight: 500;
  }

  .form-control {
    border-radius: 0.5rem;
  }

  .btn-submit {
    margin-top: 20px;
    width: 100%;
    border-radius: 0.5rem;
  }

  .card-header h5 {
    margin: 0;
  }
</style>

<div id="main-content">
  <div class="container">
    <div class="form-section">
      <div class="card-header bg-success text-white mb-4 rounded p-2">
        <h5><i class="fas fa-map-marker-alt me-2"></i> Add New Destination</h5>
      </div>

      <form method="POST" enctype="multipart/form-data" id="destinationForm">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label"><i class="fas fa-tag me-1"></i> Destination Name</label>
            <input type="text" name="name" class="form-control" placeholder="e.g. Boracay Island" required>
          </div>

          <div class="col-md-6">
            <label class="form-label"><i class="fas fa-map-marker-alt me-1"></i> Address</label>
            <input type="text" name="address" class="form-control" placeholder="Complete address" required>
          </div>

          <div class="col-md-6">
            <label class="form-label"><i class="fas fa-phone me-1"></i> Contact Number</label>
            <input type="text" name="contact_number" class="form-control" placeholder="e.g. 09123456789" required>
          </div>

          <div class="col-md-6">
            <label class="form-label"><i class="fas fa-image me-1"></i> Upload Image</label>
            <input type="file" name="image" class="form-control" required>
          </div>

          <div class="col-md-12">
            <label class="form-label"><i class="fas fa-align-left me-1"></i> Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Brief description" required></textarea>
          </div>
        </div>

        <button type="button" onclick="confirmInsert()" class="btn btn-success btn-submit">
          <i class="fas fa-plus me-1"></i> Add Destination
        </button>
      </form>
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
