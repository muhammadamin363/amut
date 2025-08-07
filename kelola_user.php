<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
include 'db.php';

// Ambil semua data user
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY username ASC");
?>

<div class="main-content">
    <h2>Kelola User</h2>

    <!-- Tombol Tambah User -->
    <a href="tambah_user.php" class="btn btn-success mb-3">+ Tambah User</a>

    <!-- Tabel Data User -->
    <table border="1" cellspacing="0" cellpadding="6" style="width:100%; border-collapse:collapse;">
        <thead style="background:#f2f2f2;">
            <tr>
                <th style="width:5%;">No</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th style="width:20%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td style='text-align:center;'>{$no}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['password']}</td>
                        <td>{$row['role']}</td>
                        <td style='text-align:center;'>
                            <a href='edit_user.php?id={$row['id']}' style='padding:4px 8px; background:orange; color:white; text-decoration:none; border-radius:3px;'>Edit</a>
                            <a href='hapus_user.php?id={$row['id']}' style='padding:4px 8px; background:red; color:white; text-decoration:none; border-radius:3px;' onclick='return confirm(\"Yakin hapus user ini?\")'>Hapus</a>
                        </td>
                    </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center;'>Belum ada data user</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
