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
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
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
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire('Error', 'Something went wrong with the database.', 'error');
            </script>";
        }
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire('Upload Failed', 'Image could not be uploaded.', 'error');
        </script>";
    }
}

?>


<div id="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Add New Destination</h5>
                    </div>
                    <div class="card-body bg-light">
                        <form method="POST" enctype="multipart/form-data" id="destinationForm">
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-tag me-2"></i>Destination Name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Boracay Island" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-align-left me-2"></i>Description</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Brief description of the destination" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-map-marker me-2"></i>Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Complete address" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-phone-alt me-2"></i>Contact Number</label>
                                <input type="text" name="contact_number" class="form-control" placeholder="e.g. 09123456789" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-image me-2"></i>Upload Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="text-end">
                                <button type="button" onclick="confirmInsert()" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Add Destination
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center small">
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