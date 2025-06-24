<?php include 'session.php'; ?>
<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Staff - TREXO Group of Hotels</title>
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
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #4ecdc4, #45b7d1);
            color: white;
            padding: 2rem;
            border-radius: 20px 20px 0 0;
            text-align: center;
        }

        .form-header h2 {
            font-weight: 700;
            margin: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 12px;
            padding: 0.75rem;
            border: 2px solid #e1e8ed;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4ecdc4;
            box-shadow: 0 0 0 0.2rem rgba(78, 205, 196, 0.25);
            transform: translateY(-2px);
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
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-top: 1.5rem;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #96ceb4, #4ecdc4);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
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

        .shape1 {
            top: 10%;
            left: 10%;
            width: 80px;
            height: 80px;
            background: #4ecdc4;
            border-radius: 50%;
        }

        .shape2 {
            top: 20%;
            right: 10%;
            width: 60px;
            height: 60px;
            background: #45b7d1;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation-delay: 2s;
        }

        .shape3 {
            bottom: 20%;
            left: 20%;
            width: 100px;
            height: 100px;
            background: #96ceb4;
            border-radius: 20px;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0); }
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

<div class="container form-container">
    <a href="index.php" class="btn-back">
        <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
    </a>

    <div class="form-card p-4">
        <div class="form-header">
            <h2><i class="fas fa-user-tie me-2"></i> Add Staff Member</h2>
        </div>

        <form method="POST" class="mt-4">
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required placeholder="Enter staff name">
            </div>

            <div class="form-group">
                <label class="form-label">Position</label>
                <input type="text" name="position" class="form-control" required placeholder="Enter staff position">
            </div>

            <div class="form-group">
                <label class="form-label">Salary</label>
                <input type="number" name="salary" class="form-control" required placeholder="Enter salary">
            </div>

            <div class="form-group">
                <label class="form-label">Contact</label>
                <input type="text" name="contact" class="form-control" required placeholder="Enter contact number">
            </div>

            <div class="form-group">
                <label class="form-label">Select Department</label>
                <select name="department_id" class="form-control" required>
                    <option disabled selected value="">Choose Department</option>
                    <?php
                    $depts = mysqli_query($conn, "SELECT * FROM Department");
                    while ($d = mysqli_fetch_assoc($depts)) {
                        echo "<option value='{$d['department_id']}'>{$d['department_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" name="submit" class="btn-submit mt-3">
                <i class="fas fa-plus me-2"></i> Add Staff
            </button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $position = $_POST['position'];
            $salary = $_POST['salary'];
            $contact = $_POST['contact'];
            $department_id = $_POST['department_id'];

            $sql = "INSERT INTO Staff (name, position, salary, contact, department_id) 
                    VALUES ('$name', '$position', '$salary', '$contact', '$department_id')";

            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success mt-4'><i class='fas fa-check-circle me-2'></i> Staff member added successfully!</div>";
            } else {
                echo "<div class='alert alert-danger mt-4'><i class='fas fa-exclamation-circle me-2'></i> Error: " . mysqli_error($conn) . "</div>";
            }
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
