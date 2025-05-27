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
    public static function create($data)
    {
        require_once 'models/db.php';
        $conn = connectDB();


        // Gán giá trị mặc định nếu thiếu
        $vehicle_id = $data['vehicle_id'];
        $violation_time = $data['date'] . ' '. $data['time'];
        $location = $data['location'];
        $violation_type = $data['type'];
        $fine_amount = $data['fine'];
        $status = $data['status'] ?? 'chưa thanh toán';
        $image_url = $data['image'] ?? null;
        $video_url = $data['video_url'] ?? null;


        $stmt = $conn->prepare("INSERT INTO violations (vehicle_id, violation_time, location, violation_type, fine_amount, status, image_url, video_url, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param(
            "isssdsss",
            $vehicle_id,
            $violation_time,
            $location,
            $violation_type,
            $fine_amount,
            $status,
            $image_url,
            $video_url
        );
        $result = $stmt->execute();


        $stmt->close();
        $conn->close();
        return $result;
    }
    public static function getRawSql($data) {
    $vehicle_id = $data['vehicle_id'] ?? 'NULL';
    $violation_time = isset($data['violation_time']) ? "'" . addslashes($data['violation_time']) . "'" : 'NULL';
    $location = isset($data['location']) ? "'" . addslashes($data['location']) . "'" : 'NULL';
    $violation_type = isset($data['violation_type']) ? "'" . addslashes($data['violation_type']) . "'" : 'NULL';
    $fine_amount = $data['fine_amount'] ?? 0;
    $status = isset($data['status']) ? "'" . addslashes($data['status']) . "'" : 'NULL';
    $image_url = isset($data['image_url']) ? "'" . addslashes($data['image_url']) . "'" : 'NULL';
    $video_url = isset($data['video_url']) ? "'" . addslashes($data['video_url']) . "'" : 'NULL';

    $sql = "INSERT INTO violations (vehicle_id, violation_time, location, violation_type, fine_amount, status, image_url, video_url, created_at) VALUES ($vehicle_id, $violation_time, $location, $violation_type, $fine_amount, $status, $image_url, $video_url, NOW());";
    return $sql;
}
}