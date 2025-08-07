<?php
include 'db.php';

$no_surat_tugas = $_GET['no_surat_tugas'] ?? '';

if (!$no_surat_tugas) {
    die("Nomor surat tugas tidak ditemukan.");
}

// Ambil data surat tugas
$stmt = $conn->prepare("SELECT * FROM surat_tugas WHERE no_surat_tugas = ?");
$stmt->bind_param("s", $no_surat_tugas);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    die("Data surat tugas tidak ditemukan.");
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal_surat = $_POST['tanggal_surat'];
    $uraian        = $_POST['uraian'];
    $tujuan        = $_POST['tujuan'];

    $update = $conn->prepare("UPDATE surat_tugas SET tanggal_surat=?, uraian=?, tujuan=? WHERE no_surat_tugas=?");
    $update->bind_param("ssss", $tanggal_surat, $uraian, $tujuan, $no_surat_tugas);

    if ($update->execute()) {
        header("Location: surat_tugas.php");
        exit;
    } else {
        echo "Gagal memperbarui data: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Surat Tugas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        a.btn { display:inline-block; padding:6px 12px; background:#6c757d; color:white; text-decoration:none; border-radius:4px; }
        form { max-width: 500px; }
        label { display:block; margin-top: 10px; }
        input[type=text], input[type=date], textarea {
            width:100%; padding:8px; margin-top:4px; box-sizing: border-box;
        }
        input[type=submit] {
            margin-top: 15px;
            padding: 8px 15px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<a href="surat_tugas.php" class="btn">← Kembali</a>

<h2>Edit Surat Tugas</h2>

<form method="POST">
    <label>No Surat Tugas</label>
    <input type="text" name="no_surat_tugas" value="<?= htmlspecialchars($data['no_surat_tugas']) ?>" readonly>

    <label>Tanggal Surat</label>
    <input type="date" name="tanggal_surat" value="<?= htmlspecialchars($data['tanggal_surat']) ?>" required>

    <label>Uraian</label>
    <textarea name="uraian" rows="3" required><?= htmlspecialchars($data['uraian']) ?></textarea>

    <label>Tujuan</label>
    <textarea name="tujuan" rows="3" required><?= htmlspecialchars($data['tujuan']) ?></textarea>

    <input type="submit" value="Simpan Perubahan">
</form>

</body>
</html>
