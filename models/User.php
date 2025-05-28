<?php
require_once 'models/db.php';

class User {
    public static function findByUsername($username) {
        $conn = connectDB();
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public static function create($data) {
        $conn = connectDB();
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $data['username'], $data['password']);
        return $stmt->execute();
    }
    public static function getAll() {
        require_once 'models/db.php';
        $conn = connectDB();
        $sql = "SELECT id, full_name FROM users";
        $result = $conn->query($sql);
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        $conn->close();
        return $users;
    }
    public static function findByCccd($cccd) {
    require_once 'models/db.php';
    $conn = connectDB();
    $stmt = $conn->prepare("SELECT * FROM users WHERE cccd = ?");
    $stmt->bind_param("s", $cccd);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $user;
}
}

