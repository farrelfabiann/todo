<?php
include 'config/config.php';
session_start();
// Gunakan prepared statement untuk keamanan
$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$_SESSION['user_id'] = $row['id']; 
$_SESSION['username'] = $row['name']; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = hash('sha256', $_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id']; 
        $_SESSION['username'] = $row['name']; 
        header('Location: todo.php');
        exit();
    } else {
        echo "<script>alert('Email atau password salah!')</script>";
    }
}
?>
