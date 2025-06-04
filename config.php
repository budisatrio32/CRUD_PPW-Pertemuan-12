<?php
session_start();

// TAMBAHKAN INI DI PALING ATAS
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

// ... rest of your code

// Konfigurasi database
$host = "localhost";
$username = "u985354573_BudiAdmin";
$password = "#Satr2005"; // Sesuaikan dengan password MySQL Anda, biasanya kosong
$database = "u985354573_jdwlspkbl"; // Nama database yang Anda buat

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

function logout() {
    session_destroy();
    header("Location: login.php");
    exit();
}

function getCurrentUser() {
    global $conn;
    if (isLoggedIn()) {
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE id = '$user_id'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) == 1) {
            return mysqli_fetch_assoc($result);
        }
    }
    return null;
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}
?>