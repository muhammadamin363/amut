<?php
include 'db.php';

$nip     = $_POST['nip'];
$nama    = $_POST['nama'];
$pangkat = $_POST['pangkat'];
$jabatan = $_POST['jabatan'];

// Update data
$query = "UPDATE pegawai SET nama=?, pangkat=?, jabatan=? WHERE nip=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $nama, $pangkat, $jabatan, $nip);

if ($stmt->execute()) {
    header("Location: pegawai.php");
    exit;
} else {
    echo "❌ Gagal mengupdate data: " . $conn->error;
}
