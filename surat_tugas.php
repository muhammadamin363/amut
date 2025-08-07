<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
include 'db.php';

// Ambil semua surat tugas
$suratList = $conn->query("SELECT * FROM surat_tugas ORDER BY tanggal_surat DESC");
?>

<h2>Data Surat Tugas</h2>
<a href="tambah_surat_tugas.php" class="btn btn-success mb-3">+ Tambah Surat Tugas</a>
<a href="cetak_halamanpdf.php" target="_blank" class="btn btn-success mb-3">🖨️ Cetak Halaman (PDF)</a>

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>No Surat Tugas</th>
            <th>Tanggal</th>
            <th>Uraian</th>
            <th>Tujuan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($suratList->num_rows > 0): ?>
            <?php while ($row = $suratList->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['no_surat_tugas'] ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_surat'])) ?></td>
                    <td><?= $row['uraian'] ?></td>
                    <td><?= $row['tujuan'] ?></td>
                    <td>
                        <a href="tambah_sppd.php?no_surat_tugas=<?= $row['no_surat_tugas'] ?>" class="btn btn-primary btn-sm">Lihat Petugas</a>
                        <a href="cetak_suratpdf.php?no_surat_tugas=<?= $row['no_surat_tugas'] ?>" class="btn btn-warning btn-sm">Cetak</a>
                        <a href="edit_surat_tugas.php?no_surat_tugas=<?= $row['no_surat_tugas'] ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="hapus_surat_tugas.php?no_surat_tugas=<?= urlencode($row['no_surat_tugas']) ?>"class="btn btn-danger btn-sm"onclick="return confirm('Hapus surat ini beserta petugasnya?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5" class="text-center">Belum ada surat tugas</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
