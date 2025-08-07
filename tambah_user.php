<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        header("Location: kelola_user.php");
        exit;
    } else {
        echo "Gagal menambah user: " . $conn->error;
    }
}
?>

<div class="main-content">
    <h2>Tambah User</h2>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Role</label>
        <select name="role" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="operator">Operator</option>
        </select>

        <br><br>
        <button type="submit" class="btn-simpan">Simpan</button>
        <a href="kelola_user.php" class="btn-batal">Batal</a>
    </form>
</div>

<style>
    label { display: block; margin-top: 10px; }
    input[type=text], input[type=password], select { width: 300px; padding: 5px; }
    .btn-simpan { background: green; color: white; padding: 6px 12px; border: none; }
    .btn-batal { background: gray; color: white; padding: 6px 12px; text-decoration: none; }
</style>

<?php include 'footer.php'; ?>
