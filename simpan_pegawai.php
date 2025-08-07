<?php
include 'db.php';

$nip     = $_POST['nip'];
$nama    = $_POST['nama'];
$pangkat = $_POST['pangkat'];
$jabatan = $_POST['jabatan'];

// Simpan data
$query = "INSERT INTO pegawai (nip, nama, pangkat, jabatan) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $nip, $nama, $pangkat, $jabatan);

if ($stmt->execute()) {
    header("Location: pegawai.php");
    exit;
} else {
    echo "❌ Gagal menambahkan data: " . $conn->error;
}
