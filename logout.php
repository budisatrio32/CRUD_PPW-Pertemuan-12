<?php
session_start();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
echo "<script>
        alert('Logout berhasil, $username! Terima kasih telah menggunakan ScoreZone.');
        window.location.href = 'login.php';
    </script>";
exit();
?>