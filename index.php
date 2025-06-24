<?php include 'session.php'; ?>
<?php include 'header.php'; ?>
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Hotel Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Your full style copied exactly */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .dashboard-container { padding: 2rem 0; }
        .welcome-card { background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); overflow: hidden; }
        .welcome-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4); }
        .welcome-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; margin: -1.5rem -1.5rem 2rem -1.5rem; border-radius: 20px 20px 0 0; }
        .welcome-title { font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
        .role-badge { background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 25px; font-size: 0.9rem; font-weight: 500; }
        .logout-btn { background: linear-gradient(135deg, #ff6b6b, #ee5a52); border: none; padding: 0.75rem 2rem; border-radius: 25px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(255,107,107,0.4); }
        .logout-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(255,107,107,0.6); background: linear-gradient(135deg, #ee5a52, #ff6b6b); }
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 2rem; }
        .menu-item { background: white; border-radius: 15px; padding: 2rem; text-decoration: none; color: #333; transition: all 0.3s ease; box-shadow: 0 5px 20px rgba(0,0,0,0.08); position: relative; }
        .menu-item:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.15); text-decoration: none; color: #333; }
        .menu-item::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent); transition: left 0.5s; }
        .menu-item:hover::before { left: 100%; }
        .menu-icon { font-size: 2.5rem; margin-bottom: 1rem; display: block; }
        .menu-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; }
        .menu-description { font-size: 0.9rem; color: #666; margin: 0; }
        .floating-shapes { position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: -1; overflow: hidden; }
        .shape { position: absolute; opacity: 0.1; animation: float 6s ease-in-out infinite; }
        .shape1 { top: 10%; left: 10%; width: 80px; height: 80px; background: #4ecdc4; border-radius: 50%; }
        .shape2 { top: 20%; right: 10%; width: 60px; height: 60px; background: #45b7d1; border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; animation-delay: 2s; }
        .shape3 { bottom: 20%; left: 20%; width: 100px; height: 100px; background: #96ceb4; border-radius: 20px; animation-delay: 4s; }
        @keyframes float { 0%,100% { transform: translateY(0) rotate(0); } 50% { transform: translateY(-20px) rotate(180deg); } }
        @media (max-width: 768px) { .menu-grid { grid-template-columns: 1fr; } .welcome-title { font-size: 1.5rem; } }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
    </div>

    <div class="container dashboard-container">
        <div class="welcome-card p-0">
            <div class="welcome-header">
                <h1 class="welcome-title">
                    <i class="fas fa-hotel me-3"></i> Welcome Back!
                </h1>
                <p class="mb-2 fs-5"><?php echo $_SESSION['username']; ?></p>
                <span class="role-badge">
                    <i class="fas fa-user-tag me-2"></i>
                    <?php echo $_SESSION['role']; ?>
                </span>
            </div>

            <div class="p-4">
                <div class="d-flex justify-content-end mb-4">
                    <a href="logout.php" class="btn btn-danger logout-btn">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </div>

                <div class="menu-grid">
                    <a href="add_guest.php" class="menu-item">
                        <i class="fas fa-user-plus menu-icon"></i>
                        <div class="menu-title">Add Guest</div>
                        <p class="menu-description">Register new guests to the system</p>
                    </a>

                    <a href="view_guests.php" class="menu-item">
                        <i class="fas fa-users menu-icon"></i>
                        <div class="menu-title">View Guests</div>
                        <p class="menu-description">Browse and manage guest information</p>
                    </a>

                    <a href="book_room.php" class="menu-item">
                        <i class="fas fa-calendar-check menu-icon"></i>
                        <div class="menu-title">Book Room</div>
                        <p class="menu-description">Create new room reservations</p>
                    </a>

                    <a href="view_bookings.php" class="menu-item">
                        <i class="fas fa-clipboard-list menu-icon"></i>
                        <div class="menu-title">View Bookings</div>
                        <p class="menu-description">Manage existing reservations</p>
                    </a>

                    <a href="add_room.php" class="menu-item">
                        <i class="fas fa-plus-square menu-icon"></i>
                        <div class="menu-title">Add Room</div>
                        <p class="menu-description">Add new rooms to inventory</p>
                    </a>

                    <a href="view_rooms.php" class="menu-item">
                        <i class="fas fa-bed menu-icon"></i>
                        <div class="menu-title">View Rooms</div>
                        <p class="menu-description">Manage room availability and details</p>
                    </a>

                    <!-- NEW: Department & Staff -->
                    <a href="add_department.php" class="menu-item">
                        <i class="fas fa-building menu-icon"></i>
                        <div class="menu-title">Add Department</div>
                        <p class="menu-description">Create new hotel departments</p>
                    </a>

                    <a href="view_departments.php" class="menu-item">
                        <i class="fas fa-sitemap menu-icon"></i>
                        <div class="menu-title">View Departments</div>
                        <p class="menu-description">Browse all departments</p>
                    </a>

                    <a href="add_staff.php" class="menu-item">
                        <i class="fas fa-user-tie menu-icon"></i>
                        <div class="menu-title">Add Staff</div>
                        <p class="menu-description">Register new hotel employees</p>
                    </a>

                    <a href="view_staff.php" class="menu-item">
                        <i class="fas fa-users-cog menu-icon"></i>
                        <div class="menu-title">View Staff</div>
                        <p class="menu-description">Browse and manage staff records</p>
                    </a>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
