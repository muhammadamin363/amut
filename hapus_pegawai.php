<?php
include 'db.php';

$nip = $_GET['nip'] ?? '';

if ($nip) {
    $stmt = $conn->prepare("DELETE FROM pegawai WHERE nip=?");
    $stmt->bind_param("s", $nip);
    if ($stmt->execute()) {
        header("Location: pegawai.php");
        exit;
    } else {
        echo "❌ Gagal menghapus data: " . $conn->error;
    }
} else {
    echo "❌ NIP tidak ditemukan.";
}
