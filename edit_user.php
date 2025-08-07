<?php
include 'header.php';
include 'sidebar.php';
include 'db.php';

// Ambil data user berdasarkan ID
$id = $_GET['id'] ?? '';
if (!$id) {
    die("ID user tidak ditemukan.");
}

$result = $conn->query("SELECT * FROM users WHERE id='$id'");
if ($result->num_rows === 0) {
    die("User tidak ditemukan.");
}
$user = $result->fetch_assoc();

// Proses update user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // bisa langsung disimpan apa adanya, atau di-hash
    $role     = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET username=?, password=?, role=? WHERE id=?");
    $stmt->bind_param("sssi", $username, $password, $role, $id);

    if ($stmt->execute()) {
        echo "<script>alert('User berhasil diperbarui');window.location='kelola_user.php';</script>";
    } else {
        echo "Gagal mengupdate user: " . $conn->error;
    }
}
?>

<div class="main-content">
    <h2>Edit User</h2>

    <form method="POST">
        <div style="margin-bottom:10px;">
            <label>Username</label><br>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required style="width:300px; padding:5px;">
        </div>
        <div style="margin-bottom:10px;">
            <label>Password</label><br>
            <input type="text" name="password" value="<?= htmlspecialchars($user['password']) ?>" required style="width:300px; padding:5px;">
        </div>
        <div style="margin-bottom:10px;">
            <label>Role</label><br>
            <select name="role" required style="width:300px; padding:5px;">
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="operator" <?= $user['role'] === 'operator' ? 'selected' : '' ?>>Operator</option>
            </select>
        </div>
        <button type="submit" style="padding:6px 12px; background:green; color:white; border:none; border-radius:4px;">Simpan</button>
        <a href="kelola_user.php" style="padding:6px 12px; background:gray; color:white; text-decoration:none; border-radius:4px;">Batal</a>
    </form>
</div>

<?php include 'footer.php'; ?>
