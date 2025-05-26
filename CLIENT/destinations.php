<?php 
include_once "includes/config.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
include_once "includes/navbar.php";

$sql = "SELECT * FROM destination ORDER BY id DESC";
$result = $conn->query($sql);


$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$escaped = $conn->real_escape_string($search);

$sql = "SELECT * FROM destination";
if (!empty($escaped)) {
    $sql .= " WHERE name LIKE '%$escaped%' OR address LIKE '%$escaped%'";
}
$sql .= " ORDER BY id DESC";

$result = $conn->query($sql);

?>

<style>
  body {
    background-color: #f4f6f9;
  }

  .card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
  }

  .card-img-top {
    height: 220px;
    object-fit: cover;
  }

  .card-title {
    font-size: 1.25rem;
    font-weight: 600;
  }

  .info-icon {
    width: 20px;
  }

  .card-body p {
    margin-bottom: 0.4rem;
  }

  .btn-view {
    border-radius: 50px;
    font-size: 0.9rem;
    padding: 6px 16px;
  }
  .input-group input {
  border-radius: 50px 0 0 50px;
}

.input-group button {
  border-radius: 0 50px 50px 0;
}
</style>

<div id="main-content">
  <div class="container py-5">
    <h2 class="mb-4 text-center text-primary fw-bold">
      <i class="fas fa-map-marked-alt me-2"></i>Suggested Destinations
    </h2>

    <form method="GET" class="mb-4">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search destinations..." value="<?= htmlspecialchars($search) ?>">
        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
      </div>
    </form>

    <div class="row g-4">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card h-100">
            <img src="uploads/<?= $row['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-dark"><?= htmlspecialchars($row['name']) ?></h5>
              <p class="text-muted"><i class="fas fa-map-marker-alt text-danger me-2 info-icon"></i><strong>Address:</strong> <?= htmlspecialchars($row['address']) ?></p>
              <p class="text-muted"><i class="fas fa-phone text-success me-2 info-icon"></i><strong>Contact:</strong> <?= htmlspecialchars($row['contact_number']) ?></p>

              <div class="mt-auto text-end">
                <a href="destination_details.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-view" title="View more info">
                  <i class="fas fa-info-circle me-1"></i>View Details
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
