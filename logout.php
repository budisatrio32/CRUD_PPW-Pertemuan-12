<?php
session_start();

// Simpan nama user sebelum logout (untuk pesan)
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';

// Hapus semua data session
$_SESSION = array();

// Hapus session cookie jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy session
session_destroy();

// Redirect ke login dengan pesan sukses
echo "<script>
        alert('Logout berhasil, $username! Terima kasih telah menggunakan ScoreZone.');
        window.location.href = 'login.php';
    </script>";
exit();
?>