<?php
include_once 'models/user.php';

class UserController {
    // Handle registration
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if ($password == $cpassword) {
                $user = new User($username, $email, $password);

                if (!$user->checkIfExists()) {
                    if ($user->create()) {
                        echo "<script>alert('Registration successful!')</script>";
                    } else {
                        echo "<script>alert('Error occurred. Try again.')</script>";
                    }
                } else {
                    echo "<script>alert('Email is already taken.')</script>";
                }
            } else {
                echo "<script>alert('Passwords do not match.')</script>";
            }
        }
    }

    // Handle login
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User("", $email, $password);

            if ($user->login()) {
                $_SESSION['email'] = $email;
                header("Location: <views>home.php");
                exit();
            } else {
                echo "<script>alert('Invalid credentials.')</script>";
            }
        }
    }

    // Logout function
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: <views>login.php");
        exit();
    }
}
?>
