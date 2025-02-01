<?php
session_start();
include 'includes/db.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = validate_input($_POST['username']);
    $password = $_POST['password'];

    // Query untuk memeriksa kecocokan username dan password
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        // Login berhasil
        $_SESSION['username'] = $username;
        echo 'success';
    } else {
        // Login gagal
        echo 'Username atau password salah.';
    }
}?>