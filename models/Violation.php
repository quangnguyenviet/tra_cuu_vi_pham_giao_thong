<?php
require_once 'models/Vehicle.php'; // Nếu cần sử dụng model Vehicle
class Violation
{
    private $id;
    private $vehicle_id;
    private $violation_time;
    private $location;
    private $violation_type;
    private $fine_amount;
    private $status;
    private $image_url;
    private $video_url;
    private $created_at;

    // Hàm tạo mới bản ghi vi phạm
    // public static function create($data)
    // {
    //     require_once 'models/db.php';
    //     $conn = connectDB();


    //     // Gán giá trị mặc định nếu thiếu
    //     $vehicle_id = $data['vehicle_id'];
    //     $violation_time = $data['date'] . ' '. $data['time'];
    //     $location = $data['location'];
    //     $violation_type = $data['type'];
    //     $fine_amount = $data['fine'];
    //     $status = $data['status'] ?? 'chưa thanh toán';
    //     $image_url = $data['image'] ?? null;
    //     $video_url = $data['video_url'] ?? null;


    //     $stmt = $conn->prepare("INSERT INTO violations (vehicle_id, violation_time, location, violation_type, fine_amount, status, image_url, video_url, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    //     $stmt->bind_param(
    //         "isssdsss",
    //         $vehicle_id,
    //         $violation_time,
    //         $location,
    //         $violation_type,
    //         $fine_amount,
    //         $status,
    //         $image_url,
    //         $video_url
    //     );
    //     $result = $stmt->execute();


    //     $stmt->close();
    //     $conn->close();
    //     return $result;
    // }

    public static function create($data)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $stmt = $conn->prepare("INSERT INTO violations (vehicle_id, violation_time, location, violation_type, fine_amount, status, image_url, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $violation_time = $data['date'] . ' ' . $data['time'];
        $status = $data['status'] ?? 'chưa thanh toán';
        $stmt->bind_param(
            "isssiss",
            $data['vehicle_id'],
            $violation_time,
            $data['location'],
            $data['type'],
            $data['fine'],
            $status,
            $data['image']
        );
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
    public static function getLatest($limit = 5)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $sql = "SELECT v.*, ve.license_plate 
            FROM violations v 
            JOIN vehicles ve ON v.vehicle_id = ve.id 
            ORDER BY v.created_at DESC 
            LIMIT ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $violations = [];
        while ($row = $result->fetch_assoc()) {
            $violations[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $violations;
    }

    public static function findById($id)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $stmt = $conn->prepare("SELECT * FROM violations WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $violation = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $violation;
    }

    public static function update($id, $data)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $stmt = $conn->prepare("UPDATE violations SET violation_time=?, location=?, violation_type=?, fine_amount=?, status=?, image_url=? WHERE id=?");
        $stmt->bind_param(
            "ssssssi",
            $data['violation_time'],
            $data['location'],
            $data['violation_type'],
            $data['fine_amount'],
            $data['status'],
            $data['image_url'],
            $id
        );
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

}