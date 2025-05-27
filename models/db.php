<?php
function connectDB() {
    $conn = new mysqli('localhost', 'root', '', 'test', 3308);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;
}
?>
