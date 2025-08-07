<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
include 'db.php';

// Ambil data ringkasan
$total_surat = $conn->query("SELECT COUNT(*) AS total FROM surat_tugas")->fetch_assoc()['total'];
$total_petugas = $conn->query("SELECT COUNT(*) AS total FROM sppd")->fetch_assoc()['total'];
$total_pegawai = $conn->query("SELECT COUNT(*) AS total FROM pegawai")->fetch_assoc()['total'];
$total_user = ($_SESSION['role'] == 'admin') ? $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'] : null;
?>

<h1 class="mb-4">Selamat Datang, <?= $_SESSION['username']; ?>!</h1>
<p class="lead">Berikut ringkasan data Sistem Informasi Perjalanan Dinas Kecamatan Amuntai Utara:</p>

<div class="row g-4 mt-3">
    <div class="col-md-3">
        <div class="card text-bg-primary h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Surat Tugas</h5>
                <p class="card-text display-6"><?= $total_surat; ?></p>
                <a href="surat_tugas.php" class="btn btn-light btn-sm">Lihat Data</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-success h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Petugas</h5>
                <p class="card-text display-6"><?= $total_petugas; ?></p>
                <a href="tambah_sppd.php" class="btn btn-light btn-sm">Lihat Data</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-danger h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Pegawai</h5>
                <p class="card-text display-6"><?= $total_pegawai; ?></p>
                <a href="pegawai.php" class="btn btn-light btn-sm">Lihat Data</a>
            </div>
        </div>
    </div>
    <?php if ($_SESSION['role'] == 'admin'): ?>
    <div class="col-md-3">
        <div class="card text-bg-warning h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total User</h5>
                <p class="card-text display-6"><?= $total_user; ?></p>
                <a href="kelola_user.php" class="btn btn-light btn-sm">Lihat Data</a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
