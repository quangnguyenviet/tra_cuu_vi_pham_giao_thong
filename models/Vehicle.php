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
    
    
     public static function getAll() {
        require_once 'models/db.php';
        $conn = connectDB();
        $sql = "SELECT v.*, u.full_name FROM vehicles v LEFT JOIN users u ON v.user_id = u.id ORDER BY v.id DESC";
        $result = $conn->query($sql);
        $vehicles = [];
        while ($row = $result->fetch_assoc()) {
            $vehicles[] = $row;
        }
        $conn->close();
        return $vehicles;
    }

    public static function create($data) {
        require_once 'models/db.php';
        $conn = connectDB();
        $stmt = $conn->prepare("INSERT INTO vehicles (license_plate, chassis_number, user_id, created_at, vehicle_type) VALUES (?, ?, ?, NOW(), ?)");
        $stmt->bind_param(
            "ssis",
            $data['license_plate'],
            $data['chassis_number'],
            $data['user_id'],
            $data['vehicle_type']
        );
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
