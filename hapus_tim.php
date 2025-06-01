<?php

include_once("config.php");
requireLogin(); // Redirect ke login jika belum login

// Include file koneksi database
include_once("config.php");

// Cek apakah ada ID yang dikirimkan
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Cek apakah tim masih punya pemain
    $check_pemain = mysqli_query($conn, "SELECT COUNT(*) as total FROM Pemain WHERE ID_TIM = '$id'");
    $pemain_count = mysqli_fetch_assoc($check_pemain)['total'];
    
    // Cek apakah tim masih ada di pertandingan
    $check_pertandingan = mysqli_query($conn, "SELECT COUNT(*) as total FROM Pertandingan WHERE ID_HOMETEAM = '$id' OR ID_AWAYTEAM = '$id'");
    $pertandingan_count = mysqli_fetch_assoc($check_pertandingan)['total'];
    
    // Jika masih ada pemain atau pertandingan, tidak bisa dihapus
    if ($pemain_count > 0 || $pertandingan_count > 0) {
        echo "<script>
                alert('Tidak bisa menghapus tim!\\n\\nTim ini masih memiliki:\\n- $pemain_count pemain\\n- $pertandingan_count pertandingan\\n\\nHapus data pemain dan pertandingan terlebih dahulu.');
                window.location.href = 'daftar_tim.php';
            </script>";
    } else {
        // Jika tidak ada data terkait, baru bisa dihapus
        $result = mysqli_query($conn, "DELETE FROM Tim WHERE ID_TIM = '$id'");
        
        if ($result) {
            echo "<script>
                    alert('Tim berhasil dihapus!');
                    window.location.href = 'daftar_tim.php';
                </script>";
        } else {
            echo "<script>
                    alert('Gagal menghapus tim!');
                    window.location.href = 'daftar_tim.php';
                </script>";
        }
    }
} else {
    // Jika tidak ada ID yang dikirimkan, kembali ke halaman daftar tim
    header("Location: daftar_tim.php");
}
?>