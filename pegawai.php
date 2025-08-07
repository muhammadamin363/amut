<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
include 'db.php';
?>

<div class="main-content">
    <h2>Data Pegawai</h2>

    <!-- Tombol Tambah -->
    <a href="tambah_pegawai.php" class="btn btn-success mb-3">+ Tambah Pegawai</a>

    <!-- Tabel Data -->
    <table id="tabelPegawai">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Pangkat/Gol</th>
                <th>Jabatan</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM pegawai ORDER BY nama ASC");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$row['nip']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['pangkat']}</td>
                <td>{$row['jabatan']}</td>
                <td>
                    <a href='edit_pegawai.php?nip={$row['nip']}' class='btn btn-edit'>Edit</a>
                    <a href='hapus_pegawai.php?nip={$row['nip']}' class='btn btn-hapus' onclick='return confirm(\"Hapus pegawai ini?\")'>Hapus</a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- JS DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script>
$(document).ready(function(){
    $('#tabelPegawai').DataTable({
        "pageLength": 10,
        "lengthMenu": [10, 25, 50, 100],
        "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(disaring dari total _MAX_ data)",
            "search": "Cari:"
        }
    });
});
</script>

<?php include 'footer.php'; ?>
