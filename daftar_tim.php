<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tim - ScoreZone</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700;800;900&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Custom CSS untuk Daftar Tim -->
    <link rel="stylesheet" href="style_daftar_tim.css">
</head>
<body>
    <?php
    include_once("config.php");
    requireLogin(); // Redirect ke login jika belum login
    ?>
    <!-- Header -->
    <header class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">Daftar Tim</h1>
                    <p class="page-subtitle">Kelola data tim sepakbola dalam database ScoreZone</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="index.php" class="btn-secondary-custom">
                        <i class="bi bi-arrow-left me-2"></i>
                        Kembali ke Home
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Action Bar -->
    <section class="action-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a href="tambah_tim.php" class="btn-primary-custom">
                        <i class="bi bi-plus-circle me-2"></i>
                        Tambah Tim Baru
                    </a>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <?php
                    include_once('config.php'); // Koneksi database

                    // Query untuk mengambil data tim
                    $query = "SELECT * FROM tim ORDER BY id_tim";
                    $result = mysqli_query($conn, $query);

                    // Cek apakah query berhasil
                    if (!$result) {
                        die("Query gagal: " . mysqli_error($conn));
                    }

                    // Hitung jumlah tim
                    $total_tim = mysqli_num_rows($result);
                    ?>
                    <span class="text-muted">
                        <i class="bi bi-info-circle me-2"></i>
                        Total: <strong><?php echo $total_tim; ?> Tim</strong> terdaftar
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <main class="py-4">
        <div class="container">
            <?php if($total_tim > 0): ?>
                <!-- Table with Data -->
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="12%">ID Tim</th>
                                    <th width="10%">Liga</th>
                                    <th width="10%">Stadion</th>
                                    <th width="8%">Logo</th>
                                    <th width="25%">Nama Tim</th>
                                    <th width="20%">Pelatih</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1; 
                                while($row = mysqli_fetch_assoc($result)): 
                                    $id_tim = $row['ID_TIM'];
                                    $id_liga = $row['ID_LIGA'];
                                    $id_stadion = $row['ID_STADION'];
                                    $logo_tim = $row['LOGO_TIM'];
                                    $nama_tim = $row['NAMA_TIM'];
                                    $pelatih = $row['PELATIH'];
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            <?php echo htmlspecialchars($id_tim); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">
                                            <?php echo htmlspecialchars($id_liga); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            <?php echo htmlspecialchars($id_stadion); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if(!empty($logo_tim) && file_exists("uploads/".$logo_tim)): ?>
                                            <img src="uploads/<?php echo htmlspecialchars($logo_tim); ?>" 
                                                class="team-logo" 
                                                alt="Logo <?php echo htmlspecialchars($nama_tim); ?>"
                                                title="Logo <?php echo htmlspecialchars($nama_tim); ?>">
                                        <?php else: ?>
                                            <div class="no-logo" title="Tidak ada logo">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($nama_tim); ?></strong>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($pelatih); ?>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="edit_tim.php?id=<?php echo urlencode($id_tim); ?>" 
                                                class="btn btn-sm btn-warning" 
                                                title="Edit Tim <?php echo htmlspecialchars($nama_tim); ?>">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="hapus_tim.php?id=<?php echo urlencode($id_tim); ?>" 
                                                class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus tim <?php echo htmlspecialchars($nama_tim); ?>?\n\nTindakan ini tidak dapat dibatalkan!')" 
                                                title="Hapus Tim <?php echo htmlspecialchars($nama_tim); ?>">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Table Footer Info -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Menampilkan <?php echo $total_tim; ?> tim dari database ScoreZone
                            </small>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Empty State -->
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h4>Belum Ada Data Tim</h4>
                    <p>Mulai dengan menambahkan tim pertama Anda ke dalam database ScoreZone</p>
                    <a href="tambah_tim.php" class="btn-primary-custom">
                        <i class="bi bi-plus-circle me-2"></i>
                        Tambah Tim Pertama
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>