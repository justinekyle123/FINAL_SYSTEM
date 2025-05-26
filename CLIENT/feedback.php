<?php
include 'includes/config.php';
include 'includes/navbar.php';
include 'includes/sidebar.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $message = trim($_POST['message']);

    if (!empty($message)) {
        $stmt = $conn->prepare("INSERT INTO feedback (user_id, message) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $message);
        $stmt->execute();
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Feedback sent successfully!',
            showConfirmButton: true,
        }).then(() => {
            window.location.href = 'feedback.php';
        });
        </script>";
    }
}
?>

<div id="main-content">
  <div class="container py-5">
    <h2><i class="fas fa-comment-dots me-2"></i>Send Feedback</h2>

    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success">Thank you for your feedback!</div>
    <?php endif; ?>

    <form id="feedbackForm" method="POST">
      <div class="mb-3">
        <label for="message" class="form-label">Your Feedback</label>
        <textarea name="message" class="form-control" rows="5" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-1"></i> Submit</button>
    </form>
  </div>
</div>

<script>
  document.getElementById('feedbackForm').addEventListener('submit', function(e) {
    e.preventDefault();

    Swal.fire({
      title: 'Submit Feedback?',
      text: "Are you sure you want to send this feedback?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, submit it!'
    }).then((result) => {
      if (result.isConfirmed) {
        this.submit(); 
      }
    });
  });
</script>
