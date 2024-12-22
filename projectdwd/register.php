<?php
include 'config/config.php';
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
    $cpassword = hash('sha256', $_POST['cpassword']); // Hash the input confirm password using SHA-256
 
    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO users (username, email, password)
                    VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('You are all set, Welcome Aboard!')</script>";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('We are Sorry. Something went Wrong.')</script>";
            }
        } else {
            echo "<script>alert('Oops, the email is already in use.')</script>";
        }
    } else {
        echo "<script>alert('Incorrect Password')</script>";
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
    <link rel="stylesheet" type="text/css" href="views/style.css">
    <title>Register Doable</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email form-login">
            <p class="login-text" style="font-size: 1.8rem; font-weight: 800; margin-top: 5px; padding: 1rem; color:#213555">Let's Sign Up First!</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email"  required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password"   required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="cpassword"  required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Sign Up</button>
            </div>
            <p class="login-register-text">Got an Account?<a href="index.php">Login</a>.</p>
        </form>
    </div>
</body>
</html>