<?php
include 'includes/config.php'; 
include 'includes/navbar.php'; 
// include 'includes/sidebar.php'; 

if (!isset($_GET['id'])) {
    echo "No destination ID provided.";
    exit;
}

$id = (int) $_GET['id'];
$sql = "SELECT * FROM destination WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Destination not found.";
    exit;
}

$destination = $result->fetch_assoc();
?>

<div id="main-content">
   <div class="container py-5">
  <div class="card shadow-lg border-0 rounded-4">
    <div class="row g-0">
      <div class="col-md-6">
        <img src="uploads/<?= htmlspecialchars($destination['image']) ?>" class="img-fluid rounded-start h-100" alt="<?= htmlspecialchars($destination['name']) ?>" style="object-fit: cover;">
      </div>
      <div class="col-md-6">
        <div class="card-body p-4">
          <h3 class="card-title text-primary fw-bold mb-3"><i class="fas fa-map-marked-alt me-2"></i><?= htmlspecialchars($destination['name']) ?></h3>
          
          <p class="card-text mb-4"><?= nl2br(htmlspecialchars($destination['description'])) ?></p>
          
          <p class="mb-2"><i class="fas fa-map-marker-alt text-danger me-2"></i><strong>Address:</strong> <?= htmlspecialchars($destination['address']) ?></p>
          <p><i class="fas fa-phone-alt text-success me-2"></i><strong>Contact:</strong> <?= htmlspecialchars($destination['contact']) ?></p>

          <form method="post" action="add_to_plan.php" class="d-inline-block" id="planForm">
            <input type="hidden" name="id" value="<?= $destination['id'] ?>">
                <button type="button" class="btn btn-success mt-4" id="addPlanBtn" onclick="confirmAdd()">
                    <i class="fas fa-plus-circle me-2"></i>Add to Plans
                </button>
        </form>

          <a href="destinations.php" class="btn btn-outline-secondary mt-4 ms-2">
            <i class="fas fa-arrow-left me-1"></i>Back to Destinations
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
function confirmAdd() {
  Swal.fire({
    title: 'Confirm submission',
    text: 'Are you sure you want to add this Plan?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Yes, submit it!',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('planForm').submit();
    }
  });
}
</script>