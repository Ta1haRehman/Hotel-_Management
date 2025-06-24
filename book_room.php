<?php include 'session.php'; ?>
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Book a Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
        }

        .booking-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            padding: 2.5rem;
            width: 100%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .form-label {
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .form-control, select {
            border-radius: 10px;
        }

        .btn-book {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            border: none;
            border-radius: 25px;
            font-weight: 600;
            padding: 0.75rem 2rem;
            color: #fff;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
        }

        .btn-book:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.6);
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

    <div class="booking-card">
        <h2><i class="fas fa-calendar-check me-2"></i>Book a Room</h2>

        <?php
        if (isset($_POST['submit'])) {
            $guest_id = $_POST['guest_id'];
            $room_id = $_POST['room_id'];
            $check_in = $_POST['check_in'];
            $check_out = $_POST['check_out'];

            $booking_query = "INSERT INTO Booking (guest_id, room_id, check_in, check_out)
                              VALUES ('$guest_id', '$room_id', '$check_in', '$check_out')";
            $update_room = "UPDATE Room SET is_available = 0 WHERE room_id = '$room_id'";

            if (mysqli_query($conn, $booking_query) && mysqli_query($conn, $update_room)) {
                echo "<div class='alert alert-success text-center'>Room booked successfully!</div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
        ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Select Guest:</label>
                <select name="guest_id" class="form-select" required>
                    <option value="">--Select--</option>
                    <?php
                    $guests = mysqli_query($conn, "SELECT * FROM Guest");
                    while ($g = mysqli_fetch_assoc($guests)) {
                        echo "<option value='{$g['guest_id']}'>{$g['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Select Room:</label>
                <select name="room_id" class="form-select" required>
                    <option value="">--Available Rooms--</option>
                    <?php
                    $rooms = mysqli_query($conn, "SELECT * FROM Room WHERE is_available = 1");
                    while ($r = mysqli_fetch_assoc($rooms)) {
                        echo "<option value='{$r['room_id']}'>{$r['room_type']} - Rs.{$r['cost']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Check-in Date:</label>
                <input type="date" name="check_in" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Check-out Date:</label>
                <input type="date" name="check_out" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-book">Book Room</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
