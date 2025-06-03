<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tim - ScoreZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700;800;900&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_daftar_tim.css">

    <style>
        .pagination-custom {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            gap: 5px;
        }
        .pagination-custom a, .pagination-custom span {
            padding: 10px 15px;
            border: 1px solid #444;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
            background-color: #2a2a2a;
        }
        .pagination-custom a:hover {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }
        .pagination-custom .current {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        .search-section {
            margin-bottom: 20px;
        }
        .search-box {
            background-color: #2a2a2a;
            border: 1px solid #444;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
        }
        .search-box:focus {
            outline: none;
            border-color: #007bff;
            background-color: #333;
        }
        .search-box::placeholder {
            color: #ccc;
        }
        .stats-info {
            background-color: #2a2a2a;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <?php
    include_once("config.php");
    requireLogin();
    $limit = 10; 
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
    $search_query = '';
    if (!empty($search)) {
        $search_query = "WHERE NAMA_TIM LIKE '%$search%' OR PELATIH LIKE '%$search%' OR ID_TIM LIKE '%$search%' OR ID_LIGA LIKE '%$search%' OR ID_STADION LIKE '%$search%'";
    }

    $count_query = "SELECT COUNT(*) as total FROM tim $search_query";
    $count_result = mysqli_query($conn, $count_query);
    
    if (!$count_result) {
        die("Query gagal: " . mysqli_error($conn));
    }
    
    $total_data = mysqli_fetch_assoc($count_result)['total'];
    $total_pages = ceil($total_data / $limit);

    $query = "SELECT * FROM tim $search_query ORDER BY ID_TIM LIMIT $limit OFFSET $offset";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }
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
                    <span class="text-muted">
                        <i class="bi bi-info-circle me-2"></i>
                        Total: <strong><?php echo $total_data; ?> Tim</strong> terdaftar
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <main class="py-4">
        <div class="container">
            <!-- Search Section -->
            <div class="search-section">
                <form method="GET" class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control search-box" 
                                placeholder="Cari berdasarkan nama tim, pelatih, ID tim, liga, atau stadion..." 
                                value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Cari
                        </button>
                    </div>
                </form>
            </div>

            <!-- Stats Info -->
            <div class="stats-info">
                <div>
                    <strong>Total Data: <?php echo $total_data; ?></strong>
                    <?php if (!empty($search)): ?>
                        <span> | Hasil pencarian untuk: "<em><?php echo htmlspecialchars($search); ?></em>"</span>
                    <?php endif; ?>
                </div>
                <div>Halaman <?php echo $page; ?> dari <?php echo $total_pages; ?></div>
            </div>

            <?php if(mysqli_num_rows($result) > 0): ?>
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
                                $no = $offset + 1; 
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
                    
                    <!-- Pagination -->
                    <?php if ($total_pages > 1): ?>
                    <div class="pagination-custom">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?php echo ($page-1); ?>&search=<?php echo urlencode($search); ?>">Previous</a>
                        <?php endif; ?>
                        
                        <?php
                        $start = max(1, $page - 2);
                        $end = min($total_pages, $page + 2);
                        
                        for ($i = $start; $i <= $end; $i++):
                        ?>
                            <?php if ($i == $page): ?>
                                <span class="current"><?php echo $i; ?></span>
                            <?php else: ?>
                                <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                        
                        <?php if ($page < $total_pages): ?>
                            <a href="?page=<?php echo ($page+1); ?>&search=<?php echo urlencode($search); ?>">Next</a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Table Footer Info -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Menampilkan <?php echo mysqli_num_rows($result); ?> dari <?php echo $total_data; ?> tim dari database ScoreZone
                            </small>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Empty State -->
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h4>
                        <?php if (!empty($search)): ?>
                            Tidak ada data yang ditemukan
                        <?php else: ?>
                            Belum Ada Data Tim
                        <?php endif; ?>
                    </h4>
                    <p>
                        <?php if (!empty($search)): ?>
                            Tidak ditemukan data tim yang sesuai dengan pencarian "<strong><?php echo htmlspecialchars($search); ?></strong>".
                            <br><a href="daftar_tim.php" class="btn-secondary-custom mt-2">Tampilkan semua data</a>
                        <?php else: ?>
                            Mulai dengan menambahkan tim pertama Anda ke dalam database ScoreZone
                        <?php endif; ?>
                    </p>
                    <?php if (empty($search)): ?>
                    <a href="tambah_tim.php" class="btn-primary-custom">
                        <i class="bi bi-plus-circle me-2"></i>
                        Tambah Tim Pertama
                    </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>