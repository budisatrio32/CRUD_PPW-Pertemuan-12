<?php

include_once("config.php");
requireLogin();

include 'config.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID Tim tidak ditemukan!'); window.location='daftar_tim.php';</script>";
    exit();
}

$id_tim = mysqli_real_escape_string($conn, $_GET['id']);

$query = "SELECT * FROM Tim WHERE ID_TIM = '$id_tim'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Tim tidak ditemukan!'); window.location='daftar_tim.php';</script>";
    exit();
}

$tim_data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_liga = mysqli_real_escape_string($conn, strtoupper(trim($_POST['id_liga'])));
    $id_stadion = mysqli_real_escape_string($conn, strtoupper(trim($_POST['id_stadion'])));
    $nama_tim = mysqli_real_escape_string($conn, trim($_POST['nama_tim']));
    $pelatih = mysqli_real_escape_string($conn, trim($_POST['pelatih']));

    $errors = [];
    
    if (strlen($id_liga) !== 5) {
        $errors[] = "ID Liga harus 5 karakter!";
    }
    
    if (strlen($id_stadion) !== 5) {
        $errors[] = "ID Stadion harus 5 karakter!";
    }

    $check_liga = mysqli_query($conn, "SELECT ID_LIGA FROM Liga WHERE ID_LIGA = '$id_liga'");
    if (mysqli_num_rows($check_liga) == 0) {
        $errors[] = "ID Liga '$id_liga' tidak ditemukan di database!";
    }

    $check_stadion = mysqli_query($conn, "SELECT ID_STADION FROM Stadion WHERE ID_STADION = '$id_stadion'");
    if (mysqli_num_rows($check_stadion) == 0) {
        $errors[] = "ID Stadion '$id_stadion' tidak ditemukan di database!";
    }

    if (!empty($errors)) {
        $error_message = implode("\\n", $errors);
        echo "<script>alert('Error:\\n$error_message');</script>";
    } else {
        $logo_name = $tim_data['LOGO_TIM'];
        
        if (!empty($_FILES['logo_tim']['name'])) {
            if (!is_dir('uploads')) {
                mkdir('uploads', 0755, true);
            }

            $logo_tmp = $_FILES['logo_tim']['tmp_name'];
            $file_extension = pathinfo($_FILES['logo_tim']['name'], PATHINFO_EXTENSION);
            
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array(strtolower($file_extension), $allowed_types)) {
                echo "<script>alert('Format file tidak diizinkan! Gunakan JPG, PNG, atau GIF.');</script>";
            } else {
                if (!empty($tim_data['LOGO_TIM']) && file_exists("uploads/" . $tim_data['LOGO_TIM'])) {
                    unlink("uploads/" . $tim_data['LOGO_TIM']);
                }
                
                $unique_name = $id_tim . '_' . time() . '.' . $file_extension;
                
                if (move_uploaded_file($logo_tmp, "uploads/$unique_name")) {
                    $logo_name = $unique_name;
                } else {
                    echo "<script>alert('Gagal upload logo baru!');</script>";
                }
            }
        }

        if (!isset($error_message)) {
            $update_query = "UPDATE Tim SET 
                            ID_LIGA = '$id_liga',
                            ID_STADION = '$id_stadion',
                            LOGO_TIM = " . ($logo_name ? "'$logo_name'" : "NULL") . ",
                            NAMA_TIM = '$nama_tim',
                            PELATIH = '$pelatih'
                            WHERE ID_TIM = '$id_tim'";
            
            if (mysqli_query($conn, $update_query)) {
                echo "<script>
                        alert('Tim \"$nama_tim\" berhasil diupdate!'); 
                        window.location='daftar_tim.php';
                    </script>";
            } else {
                echo "<script>alert('Gagal mengupdate tim: " . mysqli_error($conn) . "');</script>";
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
    <title>Edit Tim - ScoreZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700;800;900&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style_edit_tim.css">
    
</head>
<body>
    <!-- Back Button -->
    <a href="daftar_tim.php" class="back-button">
        <i class="bi bi-arrow-left"></i>
    </a>

    <!-- Main Container -->
    <div class="main-container">
        <div class="form-section">
            <h1 class="page-title">Edit Tim</h1>
            <p class="page-subtitle">Update data tim: <strong><?php echo htmlspecialchars($tim_data['NAMA_TIM']); ?></strong></p>
            
            <div class="form-wrapper">
                <!-- Info Box -->
                <div class="info-box">
                    <h6><i class="bi bi-pencil-square"></i> Mode Edit</h6>
                    <ul>
                        <li>ID Tim tidak dapat diubah</li>
                        <li>Logo baru akan mengganti logo lama</li>
                        <li>Kosongkan logo jika tidak ingin mengubah</li>
                    </ul>
                </div>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="id_tim" class="form-label">ID_TIM</label>
                        <input type="text" class="form-control" id="id_tim" name="id_tim" 
                                value="<?php echo htmlspecialchars($tim_data['ID_TIM']); ?>" readonly>
                        <div class="helper-text">ID Tim tidak dapat diubah</div>
                    </div>

                    <div class="mb-4">
                        <label for="id_liga" class="form-label">ID_LIGA *</label>
                        <input type="text" class="form-control" id="id_liga" name="id_liga" required 
                                value="<?php echo htmlspecialchars($tim_data['ID_LIGA']); ?>"
                                maxlength="5" pattern="[A-Z0-9]{5}"
                                title="5 karakter huruf besar dan angka">
                        <div class="helper-text">ID liga yang sudah ada di database</div>
                    </div>

                    <div class="mb-4">
                        <label for="id_stadion" class="form-label">ID_STADION *</label>
                        <input type="text" class="form-control" id="id_stadion" name="id_stadion" required 
                                value="<?php echo htmlspecialchars($tim_data['ID_STADION']); ?>"
                                maxlength="5" pattern="[A-Z0-9]{5}"
                                title="5 karakter huruf besar dan angka">
                        <div class="helper-text">ID stadion kandang yang sudah ada di database</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">LOGO_TIM</label>
                        
                        <!-- Current Logo Display -->
                        <div class="current-logo">
                            <?php if (!empty($tim_data['LOGO_TIM']) && file_exists("uploads/".$tim_data['LOGO_TIM'])): ?>
                                <img src="uploads/<?php echo htmlspecialchars($tim_data['LOGO_TIM']); ?>" 
                                    alt="Logo <?php echo htmlspecialchars($tim_data['NAMA_TIM']); ?>">
                                <small class="text-muted">Logo saat ini</small>
                            <?php else: ?>
                                <div class="no-logo-placeholder">
                                    <i class="bi bi-image"></i>
                                </div>
                                <small class="text-muted">Tidak ada logo</small>
                            <?php endif; ?>
                        </div>
                        
                        <div class="file-upload-wrapper">
                            <label for="logo_tim" class="file-upload-btn">
                                <i class="bi bi-cloud-upload"></i>
                                Ganti Logo
                            </label>
                            <input type="file" id="logo_tim" name="logo_tim" class="file-upload-input" 
                                    accept="image/jpeg,image/png,image/gif">
                            <div class="helper-text">Upload logo baru untuk mengganti yang lama (Opsional)</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="nama_tim" class="form-label">NAMA_TIM *</label>
                        <input type="text" class="form-control" id="nama_tim" name="nama_tim" required 
                                value="<?php echo htmlspecialchars($tim_data['NAMA_TIM']); ?>"
                                maxlength="50">
                    </div>

                    <div class="mb-4">
                        <label for="pelatih" class="form-label">PELATIH *</label>
                        <input type="text" class="form-control" id="pelatih" name="pelatih" required 
                                value="<?php echo htmlspecialchars($tim_data['PELATIH']); ?>"
                                maxlength="50">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-submit">
                            <i class="bi bi-save me-2"></i>
                            Update Tim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>