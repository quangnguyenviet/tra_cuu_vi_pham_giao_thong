<?php
class Vehicle{

    public static function findById($id) {
        require_once 'models/db.php';
        $conn = connectDB();
        $stmt = $conn->prepare("SELECT * FROM vehicles WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $vehicle = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $vehicle;
    }
    public static function findByPlate($plate) {
        require_once 'models/db.php';
        $conn = connectDB();
        $stmt = $conn->prepare("SELECT * FROM vehicles WHERE license_plate = ?");
        $stmt->bind_param("s", $plate);
        $stmt->execute();
        $result = $stmt->get_result();
        $vehicle = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $vehicle;
    }
}