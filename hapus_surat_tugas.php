<?php
include 'db.php';

if (isset($_GET['no_surat_tugas'])) {
    $no_surat = $_GET['no_surat_tugas'];

    // Hapus data petugas yang terkait
    $stmt = $conn->prepare("DELETE FROM sppd WHERE no_surat_tugas = ?");
    $stmt->bind_param("s", $no_surat);
    $stmt->execute();
    $stmt->close();

    // Hapus data surat tugas
    $stmt2 = $conn->prepare("DELETE FROM surat_tugas WHERE no_surat_tugas = ?");
    $stmt2->bind_param("s", $no_surat);
    $stmt2->execute();
    $stmt2->close();

    header("Location: surat_tugas.php");
    exit;
} else {
    echo "No Surat Tugas tidak ditemukan!";
}
?>
