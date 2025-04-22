<?php

use App\Class\Session;

if (Session::has('user_id')) {
    header("location: dashboard");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
    $conn = $db->conn();

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            Session::set('user_id', $user['id']);
            Session::set('user_name', $user['name']);
            header("Location: dashboard");
            exit;
        } else {
            Session::set('error', 'Invalid email or password.');
            header("Location: login");
            exit;
        }
    } catch (PDOException $e) {
        Session::set('error', 'Database error: ' . $e->getMessage());
        header("Location: login");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drytec Construction Services - Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="login-card bg-white">
            <div class="login-header">
                <h1 class="mb-4"><span class="text-primary-custom">DRY</span>TEC</h1>
                <p class="mb-0">Login to access your account</p>
            </div>
            <div class="card-body p-4 p-md-5">
                <h4 class="fw-bold mb-4 text-center">Welcome Back</h4>
                <?php if (Session::has('error')): ?>
                    <div class="custom-alert error-alert">
                        <strong>Oops!</strong> <?= Session::get('error'); ?>
                        <?php Session::remove('error'); ?>
                    </div>
                <?php endif; ?>


                <form action="" method="POST">
                    <div class="mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- <div class="d-flex justify-content-between mb-4">
                        <a href="#" class="text-primary-custom text-decoration-none">Forgot Password?</a>
                    </div> -->

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary-custom btn-lg py-3">Login</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="position-fixed bottom-0 start-50 translate-middle-x mb-4">
            <a href="home" class="text-dark text-decoration-none">
                <i class="bi bi-arrow-left me-2"></i>Back to Home
            </a>
        </div>
    </div>

    <script src="assets/js/bootstrap.js"></script>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    </script>
</body>

</html>