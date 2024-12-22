<?php

session_start();

include 'config/config.php';
    $errors ="";

    if (isset($_POST['submit'])){
        $task = mysqli_real_escape_string($conn, $_POST['task']);
        if (empty($task)) {
            $errors =" Jangan Lupa isi ya...";

        } 
        else {
            mysqli_query($conn, "INSERT INTO tasks(task) VALUES ('$task')");
            header('Location:dashboard.php');
            exit();
        }
        
        
    }
        // delete task
        if (isset($_GET['del_task'])) {
            $id = $_GET['del_task'];
            $sql = "DELETE FROM tasks WHERE id = $id";
            if (mysqli_query($conn,$sql )) {
                header("Location:dashboard.php");
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
    <title>DOABLE</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400;1,700&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="views/style.css" />
</head>
<body>
    
    <div class="sidebar">
        <h1>DOABLE</h1>
        <nav class="navbar">
            <ul class="nav-list">
                <li>
                    <a href="dashboard.html" aria-label="Dashboard">
                        <span class="material-symbols-outlined">home</span>
                    </a>
                </li>
                <li>
                    <a href="#" aria-label="todo">
                        <span class="material-symbols-outlined">format_list_bulleted</span>
                    </a>
                </li>
                <li>
                    <a href="ciri.html" aria-label="Ciri">
                        <span class="material-symbols-outlined">person</span>
                    </a>
                </li>
                <li>
                    <a href="profile.html" aria-label="Logout">
                        <span class="material-symbols-outlined">logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="container-fluid">
           <!-- Main content -->
        <div class="main-content">
        <header>
            <!-- Menampilkan nama pengguna yang sedang login -->

        

            <h2>Selamat Datang Doables !</h2>
                    <p>Yuk Buat To Do List Biar Makin Produktif!🌟</p>
        </header>
         </div>

        <section class="todo">
<div class="heading">
    <h2>To do list</h2>

    <form method="POST" action="dashboard.php">
        <?php if (isset($errors)){ ?>
            <p>
                <?php echo $errors; ?>
              
        </p>

        <?php }?>
        <input type="text" name="task" class="task_input" placeholder="Isi jadwal disini...">
        <button type="submit" class="add_btn" name="submit">Add task</button>
    </form>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Task</th>
            <th>Action</th>
            <th>Delete</th>
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
                            <a href="edit_task.php?id=<?php echo $row['id']; ?>"><button>Edit</button></a>
                            
                        </td>
                        
                        <td class="delete">
                            <a href="dashboard.php?del_task=<?php echo $row['id']; ?>">x</a> <!-- Removed unnecessary characters -->
                        </td>

                       
                    </tr>
                <?php $i++; } ?>    
    </tbody>
</table>
    </div>
</section>

    </div>
 
</body>
</html>
