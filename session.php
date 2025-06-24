<?php
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get user role and current page
$role = $_SESSION['role']; // 'admin', 'receptionist', 'user'
$current_page = basename($_SERVER['PHP_SELF']);

// List of pages restricted to 'admin' and 'receptionist' only
$restricted_for_user = [
    'add_guest.php',
    'view_guests.php',
    'add_department.php',
    'view_departments.php',
    'add_staff.php',
    'view_staff.php',
    'add_room.php'
];

// Block "user" from accessing restricted pages
if ($role === 'user' && in_array($current_page, $restricted_for_user)) {
    echo "<h2 style='color:red; text-align:center; margin-top:2rem;'>Access Denied 🔒<br>This page is for Admin or Receptionist only.</h2>";
    exit();
}
?>
