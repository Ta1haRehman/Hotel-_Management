<?php
include 'session.php';
include 'db.php';

// Restrict access to admin/receptionist only
if ($_SESSION['role'] == 'user') {
    echo "<h3 style='color:red;'>Access Denied: Only admin or receptionist can access this page.</h3>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Department - TREXO Group of Hotels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem 0;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #4ecdc4, #45b7d1, #96ceb4, #feca57);
        }

        .form-header {
            background: linear-gradient(135deg, #4ecdc4 0%, #45b7d1 100%);
            color: white;
            padding: 2rem;
            margin: -1.5rem -1.5rem 2rem -1.5rem;
            border-radius: 20px 20px 0 0;
            text-align: center;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .form-subtitle {
            opacity: 0.9;
            font-size: 1rem;
            margin: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.95rem;
        }

        .form-control {
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: #4ecdc4;
            box-shadow: 0 0 0 0.2rem rgba(78, 205, 196, 0.25);
            transform: translateY(-2px);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 1.1rem;
        }

        .btn-submit {
            background: linear-gradient(135deg, #4ecdc4, #45b7d1);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: white;
            width: 100%;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(78, 205, 196, 0.4);
            margin-top: 1rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(78, 205, 196, 0.6);
            background: linear-gradient(135deg, #45b7d1, #4ecdc4);
        }

        .btn-back {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 20px;
            font-weight: 600;
            color: white;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            margin-bottom: 1rem;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
            color: white;
            text-decoration: none;
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-top: 1.5rem;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #96ceb4, #4ecdc4);
            color: white;
            box-shadow: 0 4px 15px rgba(150, 206, 180, 0.4);
        }

        .alert-danger {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
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

        .shape1 { top: 10%; left: 10%; width: 80px; height: 80px; background: #4ecdc4; border-radius: 50%; animation-delay: 0s; }
        .shape2 { top: 20%; right: 10%; width: 60px; height: 60px; background: #45b7d1; border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; animation-delay: 2s; }
        .shape3 { bottom: 20%; left: 20%; width: 100px; height: 100px; background: #96ceb4; border-radius: 20px; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .form-animation {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .form-container { margin: 0 1rem; }
            .form-title { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
    </div>

    <div class="container form-container">
        <a href="index.php" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i>
            Back to Dashboard
        </a>

        <div class="form-card p-0 form-animation">
            <div class="form-header">
                <h1 class="form-title">
                    <i class="fas fa-sitemap me-2"></i>
                    Add New Department
                </h1>
                <p class="form-subtitle">Register a new department in the system</p>
            </div>

            <div class="p-4">
                <form method="POST">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-building me-2"></i>Department Name</label>
                        <div class="position-relative">
                            <input type="text" name="department_name" class="form-control" required placeholder="Enter department name">
                            <i class="fas fa-building input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-hotel me-2"></i>Hotel ID (Optional)</label>
                        <div class="position-relative">
                            <input type="number" name="hotel_id" class="form-control" placeholder="Enter hotel ID (if any)">
                            <i class="fas fa-hotel input-icon"></i>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn-submit">
                        <i class="fas fa-plus me-2"></i>Add Department
                    </button>
                </form>

                <?php
                if (isset($_POST['submit'])) {
                    $name = mysqli_real_escape_string($conn, $_POST['department_name']);
                    $hotel_id_input = trim($_POST['hotel_id']);
                    $hotel_id = ($hotel_id_input === '') ? "NULL" : intval($hotel_id_input);

                    $sql = "INSERT INTO Department (department_name, hotel_id) VALUES ('$name', $hotel_id)";
                    if (mysqli_query($conn, $sql)) {
                        echo '<div class="alert alert-success mt-3">
                                <i class="fas fa-check-circle me-2"></i>
                                Department added successfully!
                              </div>';
                    } else {
                        echo '<div class="alert alert-danger mt-3">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                Error: ' . mysqli_error($conn) . '
                              </div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
