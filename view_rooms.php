<?php include 'session.php'; ?>
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>All Rooms</title>
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
            padding: 3rem 1rem;
        }

        .room-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            padding: 2rem;
            width: 100%;
            max-width: 900px;
        }

        h2 {
            text-align: center;
            font-weight: 700;
            color: #333;
            margin-bottom: 2rem;
        }

        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .status-available {
            color: green;
            font-weight: 600;
        }

        .status-booked {
            color: red;
            font-weight: 600;
        }

        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
            text-decoration: none;
            color: #333;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #764ba2;
            text-decoration: underline;
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
            animation-delay: 0s;
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

    <div class="room-card">
        <h2><i class="fas fa-bed me-2"></i>Room List & Availability</h2>

        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th>Room ID</th>
                        <th>Room Type</th>
                        <th>Cost</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM Room";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($room = mysqli_fetch_assoc($result)) {
                            $statusClass = $room['is_available'] ? 'status-available' : 'status-booked';
                            $statusText = $room['is_available'] ? 'Available' : 'Booked';

                            echo "<tr>
                                    <td>{$room['room_id']}</td>
                                    <td>{$room['room_type']}</td>
                                    <td>Rs. {$room['cost']}</td>
                                    <td class='$statusClass'>$statusText</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No rooms added yet.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <a href="index.php" class="back-link"><i class="fas fa-arrow-left me-2"></i>Back to Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
