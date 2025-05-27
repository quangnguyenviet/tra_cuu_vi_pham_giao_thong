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
}

