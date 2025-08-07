<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
include 'db.php';

// Ambil nomor urut terbesar dari no_surat_tugas
$query = "SELECT MAX(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(no_surat_tugas, '/', 2), '/', -1) AS UNSIGNED)) AS max_no 
          FROM surat_tugas";
$result = $conn->query($query);
$data = $result->fetch_assoc();
$nextNo = $data['max_no'] ? $data['max_no'] + 1 : 1;

// Format nomor surat
$noSurat = "800.1.11.1/" . str_pad($nextNo, 2, '0', STR_PAD_LEFT) . "/CAU";

// Proses simpan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal_surat = $_POST['tanggal_surat'];
    $uraian        = $_POST['uraian'];
    $tujuan        = $_POST['tujuan'];

    $stmt = $conn->prepare("INSERT INTO surat_tugas (no_surat_tugas, tanggal_surat, uraian, tujuan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $noSurat, $tanggal_surat, $uraian, $tujuan);

    if ($stmt->execute()) {
        header("Location: surat_tugas.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Gagal menyimpan data: " . $conn->error . "</div>";
    }
}
?>

<div class="main-content">
    <h2 class="mb-4">Tambah Surat Tugas</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">No Surat Tugas</label>
            <input type="text" class="form-control" value="<?= $noSurat ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Surat</label>
            <input type="date" class="form-control" name="tanggal_surat" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Uraian</label>
            <input type="text" class="form-control" name="uraian" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tujuan</label>
            <input type="text" class="form-control" name="tujuan" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="surat_tugas.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include 'footer.php'; ?>
