<?php
include 'config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM tasks WHERE id = $id");
    $task = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $task_name = mysqli_real_escape_string($conn, $_POST['task']);
    mysqli_query($conn, "UPDATE tasks SET task='$task_name' WHERE id=$id");
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400;1,700&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="views/style.css">
    <title>Edit Task</title>

    <link rel="stylesheet" href="views/style.css">
</head>
<body>
    <div class="edit-navbar">
        <div class="edit-task">
        <h2>Update Jadwal Mu</h2>
        </div>

        <div class="edited-formulir">
        <form method="POST" action="edit_task.php?id=<?php echo $id; ?>">
            <input type="text" name="task" value="<?php echo $task['task']; ?>" required>
            <button class="edited-button" type="submit" name="update">Update Task</button>
        </form>
        </div>

    </div>
  
</body>
</html>