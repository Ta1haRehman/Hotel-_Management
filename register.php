<?php
include 'db.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user'; // default role for self-registered users

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Username already exists!";
    } else {
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if (mysqli_query($conn, $query)) {
            $success = "Account created successfully! You can now login.";
        } else {
            $error = "Something went wrong: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            padding: 2rem 3rem;
            max-width: 400px;
            width: 100%;
        }

        .register-card h2 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #333;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-register {
            background: linear-gradient(135deg, #45b7d1, #4ecdc4);
            border: none;
            border-radius: 25px;
            font-weight: 600;
            width: 100%;
            padding: 0.75rem;
            color: #fff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(70, 189, 198, 0.4);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(70, 189, 198, 0.6);
        }

        .error-msg {
            color: red;
            text-align: center;
            margin-bottom: 1rem;
        }

        .success-msg {
            color: green;
            text-align: center;
            margin-bottom: 1rem;
        }

        .floating-shapes {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .shape1 { top: 10%; left: 10%; width: 80px; height: 80px; background: #4ecdc4; border-radius: 50%; }
        .shape2 { top: 20%; right: 10%; width: 60px; height: 60px; background: #45b7d1; border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; animation-delay: 2s; }
        .shape3 { bottom: 20%; left: 20%; width: 100px; height: 100px; background: #96ceb4; border-radius: 20px; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
    </div>

    <div class="register-card">
        <h2><i class="fas fa-user-plus me-2"></i>Register</h2>
        <?php if (isset($error)) echo "<div class='error-msg'>$error</div>"; ?>
        <?php if (isset($success)) echo "<div class='success-msg'>$success</div>"; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-register">Register</button>
        </form>

        <div class="text-center mt-3">
            <a href="login.php">Already have an account? Login</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
