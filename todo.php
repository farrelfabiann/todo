<?php
include 'config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username']; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="views/style.css">
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>
        <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>

        <form action="add_todo.php" method="POST">
            <input type="text" name="task" placeholder="Add a new task..." required>
            <button type="submit">Add</button>
        </form>

        <ul>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li>
                            <span>{$row['task']}</span>
                            <a href='delete_todo.php?id={$row['id']}' class='delete-btn'>Delete</a>
                          </li>";
                }
            } else {
                echo "<li>No tasks found.</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
