<?php
require 'includes/config.php';
require 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone    = $_POST['phone'];
    $address  = $_POST['address'];
    $role     = 'user'; 

   
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        
        $result = $conn->query("SELECT * FROM users WHERE email='$email'");
        if ($result->num_rows > 0) {
            $error = "Email already registered.";
        } else {
            $sql = "INSERT INTO users (username, email, password, role, phone, address) VALUES
                    ('$username', '$email', '$password', '$role', '$phone', '$address')";
            if ($conn->query($sql)) {
                $_SESSION['registered'] = true;
                header("Location: register.php");
                exit;
            } else {
                $error = "Failed to register user.";
            }
        }
    }
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding-top: 70px; padding-left: 15px; padding-right: 15px;">
  <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
    <div class="card shadow rounded-4 border-0 glass-card p-4" style="max-width: 450px; margin: auto;">
       <h3 class="card-title mb-4 text-center fw-bold">
        <i class="fas fa-user-plus me-2"></i>Register
      </h3>

      <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="post" action="">
        <div class="mb-4">
          <label class="form-label fw-semibold" for="username"><i class="fas fa-user me-1"></i> Username</label>
          <input type="text" id="username" name="username" class="form-control form-control-lg dark-input" required maxlength="25" />
        </div>

        <div class="mb-4">
          <label class="form-label fw-semibold" for="email"><i class="fas fa-envelope me-1"></i> Email</label>
          <input type="email" id="email" name="email" class="form-control form-control-lg dark-input" required maxlength="25" />
        </div>

        <div class="mb-4">
          <label class="form-label fw-semibold" for="password"><i class="fas fa-lock me-1"></i> Password</label>
          <input type="password" id="password" name="password" class="form-control form-control-lg dark-input" required maxlength="25" />
        </div>

        <div class="mb-4">
          <label class="form-label fw-semibold" for="confirm_password"><i class="fas fa-lock me-1"></i> Confirm Password</label>
          <input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-lg dark-input" required maxlength="25" />
        </div>

        <div class="mb-4">
          <label class="form-label fw-semibold" for="phone"><i class="fas fa-phone me-1"></i> Phone</label>
          <input type="text" id="phone" name="phone" class="form-control form-control-lg dark-input" maxlength="25" />
        </div>

        <div class="mb-4">
          <label class="form-label fw-semibold" for="address"><i class="fas fa-home me-1"></i> Address</label>
          <input type="text" id="address" name="address" class="form-control form-control-lg dark-input" maxlength="25" />
        </div>

        <button type="submit" name="register" class="btn btn-warning btn-lg w-100 fw-semibold">
          <i class="fas fa-user-plus me-2"></i> Register
        </button>
      </form>

      <p class="mt-4 text-center" style="color: rgba(255,255,255,0.7);">
        Already have an account? <a href="login.php" class="text-decoration-none" style="color:#ffc107;">Login here</a>.
      </p>
    </div>
  </div>
</div>

<style>
  body {
    background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    color: white;
  }

  body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    z-index: -1;
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
    color: black;
  }

  .btn-warning:hover {
    background-color: #e0a800;
    color: black;
  }

  a.text-decoration-none:hover {
    text-decoration: underline;
  }
</style>



<?php if (isset($_SESSION['registered']) && $_SESSION['registered']): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Registration Successful!',
    text: 'Redirecting to login page...',
    showConfirmButton: true
}).then(() => {
    window.location.href = 'login.php';
});
</script>
<?php unset($_SESSION['registered']); endif; ?>


</body>
</html>