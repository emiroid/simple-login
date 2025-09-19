<?php
session_start();

// Çıkış yap
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$host = 'localhost';
$user = 'mysql'; // Coolify'den gelen kullanıcı adı
$pass = 'ANLvyZkZY5YWJcoaQJBk4I3O8qVmGIZZa5ERTCE0ZFH0kyg1ZmOfscKEAYuk2CdX'; // Coolify'den gelen şifre
$db = 'login_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ? AND password = MD5(?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Geçersiz kullanıcı adı veya şifre!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
</head>
<body>
    <h2>Giriş Yap</h2>
    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Kullanıcı Adı:</label>
        <input type="text" name="username" required><br>
        <label>Şifre:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Giriş</button>
    </form>
</body>
</html>