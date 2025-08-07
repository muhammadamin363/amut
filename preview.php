<?php
include 'db.php';

$id = $_GET['id'] ?? '';
if (!$id) {
    die('❌ Nomor surat tugas tidak ditemukan.');
}

$sql = "SELECT * FROM dinas WHERE no_surat_tugas = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("❌ Data tidak ditemukan.");
}

$data = $result->fetch_all(MYSQLI_ASSOC);
$first = $data[0];
?>

<h2>Preview Surat Tugas</h2>
<p><strong>No Surat Tugas:</strong> <?= $first['no_surat_tugas'] ?></p>
<p><strong>Tanggal Surat:</strong> <?= date('d-m-Y', strtotime($first['tanggal_surat'])) ?></p>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>No SPPD</th>
        <th>Nama</th>
        <th>Pangkat / Gol</th>
        <th>Jabatan</th>
        <th>Uraian</th>
        <th>Tujuan</th>
    </tr>
    <?php $no = 1; foreach ($data as $row): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['no_sppd'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['pangkat_gol'] ?></td>
        <td><?= $row['jabatan'] ?></td>
        <td><?= $row['uraian'] ?></td>
        <td><?= $row['tujuan'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<br>
<!-- Tombol untuk mendownload Word -->
<a href="cetak_word.php?id=<?= urlencode($id) ?>" target="_blank">
    <button>Download Word</button>
</a>
