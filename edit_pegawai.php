<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
include 'db.php';

$nip = $_GET['nip'] ?? '';
if (!$nip) {
    die("NIP tidak ditemukan.");
}

$result = $conn->query("SELECT * FROM pegawai WHERE nip='$nip'");
$data = $result->fetch_assoc();
if (!$data) {
    die("Pegawai tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama    = $_POST['nama'];
    $pangkat = $_POST['pangkat'];
    $jabatan = $_POST['jabatan'];

    $stmt = $conn->prepare("UPDATE pegawai SET nama=?, pangkat=?, jabatan=? WHERE nip=?");
    $stmt->bind_param("ssss", $nama, $pangkat, $jabatan, $nip);

    if ($stmt->execute()) {
        header("Location: pegawai.php");
        exit;
    } else {
        echo "Gagal mengedit data: " . $conn->error;
    }
}
?>

<div class="main-content">
    <h2>Edit Pegawai</h2>
    <form method="POST">
        <label>NIP</label>
        <input type="text" name="nip" value="<?= $data['nip'] ?>" readonly>

        <label>Nama</label>
        <input type="text" name="nama" value="<?= $data['nama'] ?>" required>

        <label>Pangkat/Gol</label>
        <input type="text" name="pangkat" value="<?= $data['pangkat'] ?>" required>

        <label>Jabatan</label>
        <input type="text" name="jabatan" value="<?= $data['jabatan'] ?>" required>

        <br><br>
        <button type="submit" class="btn-simpan">Simpan Perubahan</button>
        <a href="pegawai.php" class="btn-batal">Batal</a>
    </form>
</div>

<style>
    label { display: block; margin-top: 10px; }
    input[type=text] { width: 300px; padding: 5px; }
    .btn-simpan { background: orange; color: white; padding: 6px 12px; border: none; }
    .btn-batal { background: gray; color: white; padding: 6px 12px; text-decoration: none; }
</style>

<?php include 'footer.php'; ?>
