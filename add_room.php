<?php include 'session.php'; ?>
<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Room - TREXO Group of Hotels</title>
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
            position: relative;
        }

        .form-header {
            background: linear-gradient(135deg, #4ecdc4 0%, #45b7d1 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            border-radius: 20px 20px 0 0;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 12px;
            padding: 0.75rem;
        }

        .btn-submit {
            background: linear-gradient(135deg, #4ecdc4, #45b7d1);
            border: none;
            border-radius: 25px;
            color: white;
            padding: 0.75rem;
            font-weight: 600;
            width: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #45b7d1, #4ecdc4);
        }

        .alert {
            border-radius: 12px;
            padding: 1rem;
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

        .btn-back {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 20px;
            font-weight: 600;
            color: white;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            margin-bottom: 1rem;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }
    </style>
</head>
<body>

    <div class="container form-container">
        <a href="index.php" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
        </a>

        <div class="form-card p-4">
            <div class="form-header">
                <h2 class="form-title"><i class="fas fa-bed me-2"></i>Add New Room</h2>
            </div>

            <?php
            if (isset($_POST['submit'])) {
                $room_type = $_POST['room_type'];
                $cost = $_POST['cost'];
                $is_available = $_POST['is_available'];

                $query = "INSERT INTO room (room_type, cost, is_available) VALUES ('$room_type', '$cost', '$is_available')";

                if (mysqli_query($conn, $query)) {
                    echo "<div class='alert alert-success'><i class='fas fa-check-circle me-2'></i>Room added successfully!</div>";
                } else {
                    echo "<div class='alert alert-danger'><i class='fas fa-exclamation-circle me-2'></i>Error: " . mysqli_error($conn) . "</div>";
                }
            }
            ?>

            <form method="POST">
                <div class="form-group">
                    <label class="form-label">Room Type</label>
                    <input type="text" name="room_type" class="form-control" required placeholder="e.g. Luxury, Standard, Deluxe">
                </div>

                <div class="form-group">
                    <label class="form-label">Cost (per night)</label>
                    <input type="number" name="cost" class="form-control" required placeholder="e.g. 60">
                </div>

                <div class="form-group">
                    <label class="form-label">Availability</label>
                    <select name="is_available" class="form-control" required>
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                    </select>
                </div>

                <button type="submit" name="submit" class="btn-submit">
                    <i class="fas fa-plus me-2"></i>Add Room
                </button>
            </form>
        </div>
    </div>

</body>
</html>
