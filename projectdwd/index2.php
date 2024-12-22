<?php
include 'config/config.php';
    $errors ="";

    if (isset($_POST['submit'])){
        $task = mysqli_real_escape_string($conn, $_POST['task']);
        if (empty($task)) {
            $errors =" You must fill in the task";

        } 
        else {
            mysqli_query($conn, "INSERT INTO tasks(task) VALUES ('$task')");
            header('Location:index2.php');
            exit();
        }
        
        
    }
        // delete task
        if (isset($_GET['del_task'])) {
            $id = $_GET['del_task'];
            $sql = "DELETE FROM tasks WHERE id = $id";
            if (mysqli_query($conn,$sql )) {
                header("Location:index2.php");
                exit();
            };
            
        }

        $tasks = mysqli_query($conn, "SELECT * FROM tasks");


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list </Table></title>
    <link rel="stylesheet" href="views/style.css">
</head>
<body>
    <div class="heading">
    <h2>To do list</h2>

    <form method="POST" action="index2.php" class="formulir">
        <?php if (isset($errors)){ ?>
            <p><?php echo $errors; ?></p>

        <?php }?>
        <input type="text" name="task" class="task_input">
        <button type="submit" class="add_btn" name="submit">Add task</button>
    </form>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Task</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
                    <tr>
                        <!-- delete -->
                        <td><?php echo $i; ?></td>
                        <td class="task"><?php echo $row['task']; ?></td>

                         <!-- edit -->
                         <td class="edit">
                            <a href="edit_task.php?id=<?php echo $row['id']; ?>">Edit</a>
                        </td>
                        
                        <td class="delete">
                            <a href="index2.php?del_task=<?php echo $row['id']; ?>">x</a> <!-- Removed unnecessary characters -->
                        </td>

                       
                    </tr>
                <?php $i++; } ?>    
    </tbody>
</table>
    </div>
      
</body>
</html>