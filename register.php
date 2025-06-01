<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ScoreZone</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700;800;900&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style_register.css">
</head>
<body>
    <!-- Back to Home -->
    <a href="index.php" class="back-home">
        <i class="bi bi-arrow-left me-2"></i>
        Kembali
    </a>

    <div class="register-container">
        <div class="register-header">
            <h1>Register</h1>
            <p>Buat Akun Baru ScoreZone</p>
        </div>
        
        <?php
        include_once("config.php");
        
        if (isLoggedIn()) {
            header("Location: index.php");
            exit();
        }
        
        if (isset($_POST['register'])) {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            
            $errors = array();
            
            // Validasi
            if (empty($username)) {
                $errors[] = "Username tidak boleh kosong";
            } elseif (strlen($username) < 3) {
                $errors[] = "Username minimal 3 karakter";
            } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                $errors[] = "Username hanya boleh mengandung huruf, angka, dan underscore";
            }
            
            if (empty($email)) {
                $errors[] = "Email tidak boleh kosong";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Format email tidak valid";
            }
            
            if (empty($full_name)) {
                $errors[] = "Nama lengkap tidak boleh kosong";
            } elseif (strlen($full_name) < 2) {
                $errors[] = "Nama lengkap minimal 2 karakter";
            }
            
            if (empty($password)) {
                $errors[] = "Password tidak boleh kosong";
            } elseif (strlen($password) < 6) {
                $errors[] = "Password minimal 6 karakter";
            }
            
            if ($password !== $confirm_password) {
                $errors[] = "Konfirmasi password tidak cocok";
            }
            
            // Cek username dan email sudah ada atau belum
            $check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
            $check_result = mysqli_query($conn, $check_query);
            
            if (mysqli_num_rows($check_result) > 0) {
                $existing_user = mysqli_fetch_assoc($check_result);
                if ($existing_user['username'] == $username) {
                    $errors[] = "Username '$username' sudah terdaftar";
                }
                if ($existing_user['email'] == $email) {
                    $errors[] = "Email '$email' sudah terdaftar";
                }
            }
            
            if (empty($errors)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_query = "INSERT INTO users (username, email, full_name, password) 
                                VALUES ('$username', '$email', '$full_name', '$hashed_password')";
                
                if (mysqli_query($conn, $insert_query)) {
                    $success = "Registrasi berhasil! Silakan login dengan akun baru Anda.";
                    // Clear form data on success
                    unset($_POST);
                } else {
                    $errors[] = "Error database: " . mysqli_error($conn);
                }
            }
        }
        ?>
        
        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin: 0.5rem 0 0 0; padding-left: 20px;">
                    <?php foreach($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="username">
                    <i class="bi bi-person me-2"></i>Username
                </label>
                <input type="text" name="username" id="username" 
                        placeholder="Masukkan username unik"
                        value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" 
                        required>
            </div>
            
            <div class="form-group">
                <label for="email">
                    <i class="bi bi-envelope me-2"></i>Email
                </label>
                <input type="email" name="email" id="email" 
                        placeholder="Masukkan alamat email"
                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                        required>
            </div>
            
            <div class="form-group">
                <label for="full_name">
                    <i class="bi bi-person-badge me-2"></i>Nama Lengkap
                </label>
                <input type="text" name="full_name" id="full_name" 
                        placeholder="Masukkan nama lengkap"
                        value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>" 
                        required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="password">
                        <i class="bi bi-lock me-2"></i>Password
                    </label>
                    <input type="password" name="password" id="password" 
                            placeholder="Minimal 6 karakter" required>
                    <div id="password-strength" class="password-strength"></div>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">
                        <i class="bi bi-lock-fill me-2"></i>Konfirmasi Password
                    </label>
                    <input type="password" name="confirm_password" id="confirm_password" 
                            placeholder="Ulangi password" required>
                </div>
            </div>
            
            <button type="submit" name="register" class="btn">
                <i class="bi bi-person-plus me-2"></i>
                Buat Akun
            </button>
        </form>
        
        <div class="login-link">
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </div>
    </div>
</body>
</html>