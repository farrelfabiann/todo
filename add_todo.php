<?php
include 'config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $task = mysqli_real_escape_string($conn, $_POST['task']);

    $sql = "INSERT INTO todos (user_id, task) VALUES ('$user_id', '$task')";
    if ($conn->query($sql)) {
        header('Location: todo.php'); 
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
