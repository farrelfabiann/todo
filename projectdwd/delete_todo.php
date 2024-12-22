<?php
include 'config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM todos WHERE id = $id AND user_id = $user_id";
    if ($conn->query($sql)) {
        header('Location: todo.php'); 
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
