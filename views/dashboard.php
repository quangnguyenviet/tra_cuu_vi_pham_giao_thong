<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?url=login');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Xin chào, bạn đã đăng nhập thành công!</h2>
    <a href="index.php?url=logout">Đăng xuất</a>
</body>
</html>
