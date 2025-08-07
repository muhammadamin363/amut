<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip     = $_POST['nip'];
    $nama    = $_POST['nama'];
    $pangkat = $_POST['pangkat'];
    $jabatan = $_POST['jabatan'];

    $stmt = $conn->prepare("INSERT INTO pegawai (nip, nama, pangkat, jabatan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nip, $nama, $pangkat, $jabatan);

    if ($stmt->execute()) {
        header("Location: pegawai.php");
        exit;
    } else {
        echo "Gagal menambah data: " . $conn->error;
    }
}
?>

<div class="main-content">
    <h2>Tambah Pegawai</h2>
    <form method="POST">
        <label>NIP</label>
        <input type="text" name="nip" required>

        <label>Nama</label>
        <input type="text" name="nama" required>

        <label>Pangkat/Gol</label>
        <input type="text" name="pangkat" required>

        <label>Jabatan</label>
        <input type="text" name="jabatan" required>

        <br><br>
        <button type="submit" class="btn-simpan">Simpan</button>
        <a href="pegawai.php" class="btn-batal">Batal</a>
    </form>
</div>

<style>
    label { display: block; margin-top: 10px; }
    input[type=text] { width: 300px; padding: 5px; }
    .btn-simpan { background: green; color: white; padding: 6px 12px; border: none; }
    .btn-batal { background: gray; color: white; padding: 6px 12px; text-decoration: none; }
</style>

<?php include 'footer.php'; ?>
