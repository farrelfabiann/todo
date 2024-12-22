<?php
include_once 'config/config.php';

class User {
    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct($username, $email, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function create() {
        global $conn;
        $hashed_password = hash('sha256', $this->password); // Hash password
        $sql = "INSERT INTO users (username, email, password) VALUES ('$this->username', '$this->email', '$hashed_password')";
        return mysqli_query($conn, $sql);
    }

    public function checkIfExists() {
        global $conn;
        $sql = "SELECT * FROM users WHERE email='$this->email'";
        $result = mysqli_query($conn, $sql);
        return mysqli_num_rows($result) > 0;
    }

    public function login() {
        global $conn;
        $hashed_password = hash('sha256', $this->password); // Hash password
        $sql = "SELECT * FROM users WHERE email='$this->email' AND password='$hashed_password'";
        $result = mysqli_query($conn, $sql);
        return mysqli_num_rows($result) > 0;
    }
}
?>
