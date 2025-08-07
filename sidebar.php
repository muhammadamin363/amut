<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="col-md-2 bg-dark text-white min-vh-100 p-3 sidebar">
    <div class="text-center mb-4">
        <img src="logo.png" alt="Logo" style="width:80px;">
        <h5 class="mt-2">Kec. Amuntai Utara</h5>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link text-white <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                🏠 Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="surat_tugas.php" class="nav-link text-white <?php echo ($current_page == 'surat_tugas.php') ? 'active' : ''; ?>">
                📄 Surat Tugas
            </a>
        </li>
        <li class="nav-item">
            <a href="pegawai.php" class="nav-link text-white <?php echo ($current_page == 'pegawai.php') ? 'active' : ''; ?>">
                👤 Pegawai
            </a>
        </li>
        <?php if ($_SESSION['role'] == 'admin'): ?>
            <li class="nav-item">
                <a href="kelola_user.php" class="nav-link text-white <?php echo ($current_page == 'kelola_user.php') ? 'active' : ''; ?>">
                    ⚙️ Kelola User
                </a>
            </li>
        <?php endif; ?>
        <li class="nav-item">
            <a href="logout.php" class="nav-link text-white">
                Logout
            </a>
        </li>
    </ul>
</div>
<div class="col-md-10 p-4 main-content">
