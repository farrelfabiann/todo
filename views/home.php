<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['email']; ?>!</h1>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
