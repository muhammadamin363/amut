<?php
include 'db.php';

$id = $_GET['id'] ?? 0;
if (!$id) {
    die("ID tidak ditemukan");
}

// Ambil data SPPD
$sppd = $conn->query("SELECT * FROM sppd WHERE id='$id'")->fetch_assoc();
if (!$sppd) {
    die("Data SPPD tidak ditemukan");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = $_POST['nip'];
    $pegawai = $conn->query("SELECT * FROM pegawai WHERE nip='$nip'")->fetch_assoc();

    if ($pegawai) {
        $stmt = $conn->prepare("UPDATE sppd SET nip=?, nama=?, pangkat_gol=?, jabatan=? WHERE id=?");
        $stmt->bind_param("ssssi", $pegawai['nip'], $pegawai['nama'], $pegawai['pangkat'], $pegawai['jabatan'], $id);
        $stmt->execute();
    }

    header("Location: tambah_sppd.php?no_surat_tugas=" . urlencode($sppd['no_surat_tugas']));
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Petugas SPPD</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        label { display: block; margin-top: 10px; }
        select, input[type="text"], button {
            padding: 6px;
            font-size: 14px;
            width: 300px;
        }
        button { margin-top: 15px; padding: 8px 15px; }
    </style>
</head>
<body>
    <h2>Edit Petugas SPPD</h2>

    <form method="POST">
        <label>Nama Pegawai</label>
        <select name="nip" required>
            <?php
            $peg = $conn->query("SELECT * FROM pegawai ORDER BY nama");
            while ($p = $peg->fetch_assoc()):
                $sel = $p['nip'] == $sppd['nip'] ? 'selected' : '';
                echo "<option value='{$p['nip']}' $sel>{$p['nama']}</option>";
            endwhile;
            ?>
        </select>

        <br>
        <button type="submit">Simpan</button>
        <a href="tambah_sppd.php?no_surat_tugas=<?= urlencode($sppd['no_surat_tugas']) ?>">Batal</a>
    </form>
</body>
</html>
