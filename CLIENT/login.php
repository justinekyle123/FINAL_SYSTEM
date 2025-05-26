<?php
include_once "includes/header.php";
include 'includes/functions.php';
require 'includes/config.php';


if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: user.php");
    }
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        logActivity($conn, $_SESSION['user_id'], "Logged in");

         if ($user['role'] === 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: user.php");
        }
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}

?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding-top: 70px;">
  <div class="col-md-5 col-sm-8">
    <div class="card shadow rounded-4 border-0 glass-card">
      <div class="card-body p-4">
        <h3 class="card-title mb-4 text-center text-white fw-bold">
          <i class="fas fa-plane me-2"></i>Welcome Back
        </h3>

        <form method="POST" action="">
          <div class="mb-4">
            <label for="email" class="form-label text-light">Email</label>
            <input type="email" id="email" name="email" class="form-control form-control-lg dark-input" placeholder="you@example.com" required />
          </div>

          <div class="mb-4">
            <label for="password" class="form-label text-light">Password</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg dark-input" placeholder="••••••••" required />
          </div>

          <button type="submit" class="btn btn-warning btn-lg w-100 fw-semibold">
            <i class="fas fa-sign-in-alt me-2"></i>Login
          </button>
        </form>

        <p class="mt-4 text-center text-light">
          No account? <a href="register.php" class="text-warning text-decoration-none fw-semibold">Register here</a>.
        </p>
      </div>
    </div>
  </div>
</div>

<style>
  body {
  background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
  background-size: cover;
  font-family: 'Segoe UI', sans-serif;
}

  .glass-card {
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    color: white;
  }

  .dark-input {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #fff;
  }

  .dark-input::placeholder {
    color: rgba(255, 255, 255, 0.6);
  }

  .dark-input:focus {
    background-color: rgba(255, 255, 255, 0.2);
    border-color: #ffc107;
    box-shadow: none;
    color: #fff;
  }

  .btn-warning {
    background-color: #ffc107;
    border: none;
  }

  .btn-warning:hover {
    background-color: #e0a800;
  }
</style>



<!-----------------------JAVA SCRIPT HERE!--------------------------->

<?php if(isset($_SESSION['success'])): ?>
<script>
  Swal.fire({
    icon: 'success',
    title: 'Success',
    text: '<?php echo $_SESSION['success']; ?>'
  });
</script>
<?php unset($_SESSION['success']); endif; ?>

<?php if(isset($error)): ?>
<script>
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: '<?php echo $error; ?>'
  });
</script>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
