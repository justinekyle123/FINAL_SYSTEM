<?php 
include_once "includes/config.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
include_once "includes/navbar.php";

    $sql = "SELECT * FROM destination ORDER BY id DESC";
    $result = $conn->query($sql);

?>

<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        border: none;
        border-radius: 10px;
        transition: transform 0.2s;
        cursor: pointer;
    }
    .card:hover {
        transform: scale(1.02);
    }
</style>

<div id="main-content">
  <div class="container py-5">
    <h2 class="mb-4 text-center text-primary">
      <i class="fas fa-map-marked-alt me-2"></i>Suggested Destinations
    </h2>

    <div class="row g-4">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card shadow-sm h-100">
            <img src="uploads/<?= $row['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>" style="height: 200px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
              <p class="mb-1"><i class="fas fa-map-marker-alt text-danger me-2"></i><strong>Address:</strong> <?= htmlspecialchars($row['address']) ?></p>
              <p><i class="fas fa-phone text-success me-2"></i><strong>Contact:</strong> <?= htmlspecialchars($row['contact']) ?></p>
              <div class="mt-auto d-flex justify-content-between pt-3">
                <a href="destination_details.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm">
                  <i class="fas fa-info-circle me-1"></i> View Details
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
