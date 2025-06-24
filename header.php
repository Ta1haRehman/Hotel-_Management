<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">🏨 Hotel System</a>
        <div>
            <?php if (isset($_SESSION['username'])): ?>
                <span class="text-white me-3">Hello, <?php echo $_SESSION['username']; ?> (<?php echo $_SESSION['role']; ?>)</span>
                <a href="logout.php" class="btn btn-sm btn-outline-light">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">
