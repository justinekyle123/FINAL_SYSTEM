<?php

include 'includes/config.php';
include 'includes/navbar.php';
include 'includes/sidebar.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT d.* FROM plan p 
        JOIN destination d ON p.destination_id = d.id 
        WHERE p.user_id = $user_id 
        ORDER BY p.id DESC";
$result = $conn->query($sql);
?>

<div id="main-content">
    <div class="container py-5">
    <h2 class="mb-4 text-center text-primary"><i class="fas fa-suitcase-rolling me-2"></i>My Planned Destinations</h2>

    <?php if (isset($_GET['added'])): ?>
        <div class="alert alert-success">Destination added to your plans!</div>
    <?php elseif (isset($_GET['exists'])): ?>
        <div class="alert alert-warning">This destination is already in your plans.</div>
    <?php elseif (isset($_GET['removed'])): ?>
        <div class="alert alert-success">Destination removed from your plans.</div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <img src="uploads/<?= $row['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                        <p class="card-text text-muted"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                        <div class="mt-auto d-flex justify-content-between align-items-center pt-3">
                            <a href="destination_details.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-info-circle me-1"></i>View Details
                            </a>
<!--------------------------------------- Remove from plans here :()------------------------>
                            <form method="post" action="remove_plan.php" class="d-inline-block remove-plan-form">
                                <input type="hidden" name="destination_id" value="<?= $row['id'] ?>">
                                <button type="button" class="btn btn-danger btn-sm remove-plan-btn">
                                    <i class="fas fa-trash-alt me-1"></i>Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php else: ?>
        <div class="col-12 text-center">
            <div class="alert alert-info">You haven't added any destinations to your plans yet.</div>
        </div>
        <?php endif; ?>
    </div>
    </div>
</div>

<script>
  document.querySelectorAll('.remove-plan-btn').forEach(button => {
    button.addEventListener('click', function() {
      Swal.fire({
        title: 'Remove from plans?',
        text: "Are you sure you want to remove this destination from your plans?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, remove it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          this.closest('form').submit();
        }
      })
    });
  });
</script>
