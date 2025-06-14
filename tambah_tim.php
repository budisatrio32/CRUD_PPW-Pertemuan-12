<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'config.php';

    $id_tim = mysqli_real_escape_string($conn, strtoupper(trim($_POST['id_tim'])));
    $id_liga = mysqli_real_escape_string($conn, strtoupper(trim($_POST['id_liga'])));
    $id_stadion = mysqli_real_escape_string($conn, strtoupper(trim($_POST['id_stadion'])));
    $nama_tim = mysqli_real_escape_string($conn, trim($_POST['nama_tim']));
    $pelatih = mysqli_real_escape_string($conn, trim($_POST['pelatih']));

    $errors = [];
    
    if (strlen($id_tim) !== 5) {
        $errors[] = "ID Tim harus 5 karakter!";
    }
    
    if (strlen($id_liga) !== 5) {
        $errors[] = "ID Liga harus 5 karakter!";
    }
    
    if (strlen($id_stadion) !== 5) {
        $errors[] = "ID Stadion harus 5 karakter!";
    }

    $check_tim = mysqli_query($conn, "SELECT ID_TIM FROM tim WHERE ID_TIM = '$id_tim'");
    if (mysqli_num_rows($check_tim) > 0) {
        $errors[] = "ID Tim '$id_tim' sudah digunakan!";
    }

    $check_liga = mysqli_query($conn, "SELECT ID_LIGA FROM liga WHERE ID_LIGA = '$id_liga'");
    if (mysqli_num_rows($check_liga) == 0) {
        $errors[] = "ID Liga '$id_liga' tidak ditemukan di database!";
    }

    $check_stadion = mysqli_query($conn, "SELECT ID_STADION FROM stadion WHERE ID_STADION = '$id_stadion'");
    if (mysqli_num_rows($check_stadion) == 0) {
        $errors[] = "ID Stadion '$id_stadion' tidak ditemukan di database!";
    }

    if (!empty($errors)) {
        $error_message = implode("\\n", $errors);
        echo "<script>alert('Error:\\n$error_message');</script>";
    } else {
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }

        $logo_name = null;
        
        if (!empty($_FILES['logo_tim']['name'])) {
            $logo_tmp = $_FILES['logo_tim']['tmp_name'];
            $file_extension = pathinfo($_FILES['logo_tim']['name'], PATHINFO_EXTENSION);
            
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array(strtolower($file_extension), $allowed_types)) {
                echo "<script>alert('Format file tidak diizinkan! Gunakan JPG, PNG, atau GIF.');</script>";
            } else {
                $unique_name = $id_tim . '_' . time() . '.' . $file_extension;
                
                if (move_uploaded_file($logo_tmp, "uploads/$unique_name")) {
                    $logo_name = $unique_name;
                } else {
                    echo "<script>alert('Gagal upload logo!');</script>";
                }
            }
        }

        if (!isset($error_message)) {
            // 🔥 PERBAIKAN: Ganti "Tim" jadi "tim" (lowercase)
            $query = "INSERT INTO tim (ID_TIM, ID_LIGA, ID_STADION, LOGO_TIM, NAMA_TIM, PELATIH)
                    VALUES ('$id_tim', '$id_liga', '$id_stadion', " . 
                    ($logo_name ? "'$logo_name'" : "NULL") . ", '$nama_tim', '$pelatih')";
            
            if (mysqli_query($conn, $query)) {
                echo "<script>
                        alert('Tim \"$nama_tim\" berhasil ditambahkan!'); 
                        window.location='daftar_tim.php';
                    </script>";
            } else {
                echo "<script>alert('Gagal menambah tim: " . mysqli_error($conn) . "');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tim - ScoreZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700;800;900&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_tambah_tim.css">

</head>
<body>
    <!-- Back Button -->
    <a href="daftar_tim.php" class="back-button">
        <i class="bi bi-arrow-left"></i>
    </a>

    <!-- Main Container -->
    <div class="main-container">
        <div class="form-section">
            <h1 class="page-title">Tambah Tim</h1>
            
            <div class="form-wrapper">
                <!-- Info Box -->
                <div class="info-box">
                    <h6><i class="bi bi-info-circle"></i> Informasi Data</h6>
                    <ul>
                        <li><strong>Liga tersedia:</strong> LG001-LG009</li>
                        <li><strong>Stadion tersedia:</strong> ST001-ST176</li>
                        <li><strong>Format ID:</strong> Harus 5 karakter (contoh: TIM05)</li>
                    </ul>
                </div>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="id_tim" class="form-label">ID_TIM *</label>
                        <input type="text" class="form-control" id="id_tim" name="id_tim" required 
                                placeholder="TM001" maxlength="5" pattern="[A-Z0-9]{5}" 
                                title="5 karakter huruf besar dan angka">
                        <div class="helper-text">5 karakter unik untuk mengidentifikasi tim</div>
                    </div>

                    <div class="mb-4">
                        <label for="id_liga" class="form-label">ID_LIGA *</label>
                        <input type="text" class="form-control" id="id_liga" name="id_liga" required 
                                placeholder="LG001" maxlength="5" pattern="[A-Z0-9]{5}"
                                title="5 karakter huruf besar dan angka">
                        <div class="helper-text">ID liga yang sudah ada di database</div>
                    </div>

                    <div class="mb-4">
                        <label for="id_stadion" class="form-label">ID_STADION *</label>
                        <input type="text" class="form-control" id="id_stadion" name="id_stadion" required 
                                placeholder="ST001" maxlength="5" pattern="[A-Z0-9]{5}"
                                title="5 karakter huruf besar dan angka">
                        <div class="helper-text">ID stadion kandang yang sudah ada di database</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">LOGO_TIM</label>
                        <div class="file-upload-wrapper">
                            <label for="logo_tim" class="file-upload-btn">
                                <i class="bi bi-cloud-upload"></i>
                                Upload Logo
                            </label>
                            <input type="file" id="logo_tim" name="logo_tim" class="file-upload-input" 
                                    accept="image/jpeg,image/png,image/gif">
                            <div class="helper-text">Format: JPG, PNG, GIF (Opsional)</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="nama_tim" class="form-label">NAMA_TIM *</label>
                        <input type="text" class="form-control" id="nama_tim" name="nama_tim" required 
                                placeholder="Masukkan nama tim" maxlength="50">
                    </div>

                    <div class="mb-4">
                        <label for="pelatih" class="form-label">PELATIH *</label>
                        <input type="text" class="form-control" id="pelatih" name="pelatih" required 
                                placeholder="Masukkan nama pelatih" maxlength="50">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-submit">
                            <i class="bi bi-check-circle me-2"></i>
                            Tambah Tim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>