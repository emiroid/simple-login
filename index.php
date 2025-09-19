<?php
session_start();

// Kullanıcı giriş yapmamışsa login.php'ye yönlendir
if (!isset($_SESSION['username'])) {
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
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ana Sayfa</title>
</head>
<body>
    <h1>Hoşgeldin, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <a href="login.php?logout=1">Çıkış Yap</a>
</body>
</html>