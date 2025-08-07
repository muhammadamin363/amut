<?php
session_start();
include 'db.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); // tanpa md5, sesuai dengan data asli di DB

    // Cek user dan password
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Simpan session
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Perjalanan Dinas</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: white;
            padding: 25px;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-box input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        .login-box button {
            width: 100%;
            padding: 10px;
            background-color: #2c3e50;
            border: none;
            color: white;
            cursor: pointer;
        }
        .login-box button:hover {
            background-color: #34495e;
        }
        .error {
            color: red;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Login</h2>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required autofocus>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Masuk</button>
    </form>
</div>
</body>
</html>
