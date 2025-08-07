<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
include 'db.php';

// Ambil semua surat tugas
$suratList = $conn->query("SELECT no_surat_tugas FROM surat_tugas ORDER BY tanggal_surat DESC");
$no_surat_tugas = $_GET['no_surat_tugas'] ?? '';

// Proses tambah petugas
if (isset($_POST['tambah'])) {
    $no_surat_tugas = $_POST['no_surat_tugas'];
    $nip = $_POST['nip'];

    // Ambil data pegawai
    $pegawai = $conn->query("SELECT * FROM pegawai WHERE nip='$nip'")->fetch_assoc();

    // Cari No SPPD terakhir di semua data
    $last = $conn->query("SELECT MAX(CAST(no_sppd AS UNSIGNED)) as max_sppd FROM sppd")->fetch_assoc();
    $next_sppd = str_pad(($last['max_sppd'] ?? 0) + 1, 2, '0', STR_PAD_LEFT);

    // Simpan
    $stmt = $conn->prepare("INSERT INTO sppd (no_sppd, nip, nama, pangkat_gol, jabatan, no_surat_tugas) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $next_sppd, $pegawai['nip'], $pegawai['nama'], $pegawai['pangkat'], $pegawai['jabatan'], $no_surat_tugas);
    $stmt->execute();

    header("Location: tambah_sppd.php?no_surat_tugas=$no_surat_tugas");
    exit;
}

// Proses hapus petugas
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM sppd WHERE id='$id'");
    header("Location: tambah_sppd.php?no_surat_tugas=$no_surat_tugas");
    exit;
}
?>

<div class="main-content">
    <a href="surat_tugas.php" class="btn btn-success mb-3">← Kembali ke Surat Tugas</a>
    <h2>Tambah Petugas SPPD</h2>

    <!-- Pilih Surat Tugas -->
    <form method="GET" class="mb-3">
        <label class="form-label">Pilih Surat Tugas</label>
        <select name="no_surat_tugas" class="form-select" onchange="this.form.submit()">
            <option value="">-- Pilih --</option>
            <?php while ($s = $suratList->fetch_assoc()): ?>
                <option value="<?= $s['no_surat_tugas'] ?>" <?= $no_surat_tugas == $s['no_surat_tugas'] ? 'selected' : '' ?>>
                    <?= $s['no_surat_tugas'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>

    <?php if ($no_surat_tugas): ?>
        <!-- Form tambah -->
        <form method="POST" class="mb-4">
            <input type="hidden" name="no_surat_tugas" value="<?= $no_surat_tugas ?>">
            <label class="form-label">Nama Pegawai</label>
            <select name="nip" class="form-select" required>
                <option value="">-- Pilih Pegawai --</option>
                <?php
                $peg = $conn->query("SELECT * FROM pegawai ORDER BY nama");
                while ($p = $peg->fetch_assoc()):
                ?>
                    <option value="<?= $p['nip'] ?>"><?= $p['nama'] ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit" name="tambah" class="btn btn-primary mt-2">Tambah Petugas</button>
        </form>

        <!-- Tabel petugas -->
        <h4>Daftar Petugas Surat: <?= $no_surat_tugas ?></h4>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No SPPD</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Pangkat/Gol</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $petugas = $conn->query("SELECT * FROM sppd WHERE no_surat_tugas='$no_surat_tugas' ORDER BY no_sppd ASC");
            if ($petugas->num_rows > 0):
                while ($row = $petugas->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $row['no_sppd'] ?></td>
                    <td><?= $row['nip'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['pangkat_gol'] ?></td>
                    <td><?= $row['jabatan'] ?></td>
                    <td>
                        <a href="?no_surat_tugas=<?= $no_surat_tugas ?>&hapus=<?= $row['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Hapus petugas ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; else: ?>
                <tr><td colspan="6" class="text-center">Belum ada petugas</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
