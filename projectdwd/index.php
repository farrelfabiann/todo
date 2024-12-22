<?php
include 'config/config.php';
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
 
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
 
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
 
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Incorrect email or password. Give it another try!')</script>";
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400;1,700&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="views/style.css">
    <title>Doable</title>
</head>
<body>
  <div>
        <div class="background-blur">
        <img src="Logo.png" alt="">
        </div>
          <div class="container">
            <div class="index-container">
              <!-- <img src="Logo.png" alt=""> -->
              <h1>Login</h1>
            </div>
          <div>
          <img src="assets/logodoable.png" alt="" class="logo-container">
              <form action="dashboard.php" method="POST" class="form-login">
                <div class="input-group">
                  <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="input-group">
                  <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="input-group">
                  <button type="submit" class="btn">Login</button>
                </div>
                <p class="login-register-text">Belum punya akun? <a href="register.php">Daftar</a></p>
              </form>
    </div>
</body>

</html>