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


    public static function create($data)
    {
        require_once 'models/db.php';
        $conn = connectDB();

        $stmt = $conn->prepare("
        INSERT INTO violations (
            vehicle_id,
            violation_time,
            location,
            violation_type,
            fine_amount,
            status,
            image_url,
            regulation,
            regulation_desc,
            additional_penalty,
            deadline,
            expected_fine_from,
            expected_fine_to,
            created_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

        $stmt->bind_param(
            "isssdssssssiis",
            $data['vehicle_id'],
            $data['violation_time'],
            $data['location'],
            $data['violation_type'],
            $data['fine_amount'],
            $data['status'],
            $data['image_url'],
            $data['regulation'],
            $data['regulation_desc'],
            $data['additional_penalty'],
            $data['deadline'],
            $data['expected_fine_from'],
            $data['expected_fine_to'],
            $data['created_at']
        );

        $result = $stmt->execute();
        if (!$result) {
            // Xử lý lỗi nếu có
            echo "Error: " . $stmt->error;
            return false;
        }
        $stmt->close();
        $conn->close();
        return $result;
    }

    // Lấy 5 vi phạm mới nhất
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
            // thêm thông tin vào mảng
            $violations[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $violations;
    }

    public static function delete($id)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $stmt = $conn->prepare("DELETE FROM violations WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function findById($id)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $stmt = $conn->prepare("SELECT v.*, ve.license_plate FROM violations v JOIN vehicles ve ON v.vehicle_id = ve.id WHERE v.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $row;
    }

    public static function update($id, $data)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $stmt = $conn->prepare("
        UPDATE violations SET
            violation_time = ?,
            location = ?,
            violation_type = ?,
            fine_amount = ?,
            status = ?,
            image_url = ?,
            regulation = ?,
            regulation_desc = ?,
            additional_penalty = ?,
            deadline = ?,
            expected_fine_from = ?,
            expected_fine_to = ?
        WHERE id = ?
    ");
        $stmt->bind_param(
            "ssssssssssiii",
            $data['violation_time'],
            $data['location'],
            $data['violation_type'],
            $data['fine_amount'],
            $data['status'],
            $data['image_url'],
            $data['regulation'],
            $data['regulation_desc'],
            $data['additional_penalty'],
            $data['deadline'],
            $data['expected_fine_from'],
            $data['expected_fine_to'],
            $id
        );
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function getPaged($limit, $offset)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $sql = "SELECT v.*, ve.license_plate 
            FROM violations v 
            JOIN vehicles ve ON v.vehicle_id = ve.id 
            ORDER BY v.created_at DESC 
            LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
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
 

    public static function findByPlate($plate)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $sql = "SELECT v.*, ve.license_plate 
                FROM violations v 
                JOIN vehicles ve ON v.vehicle_id = ve.id 
                WHERE ve.license_plate = ?
                ORDER BY v.created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $plate);
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

    public static function findDetailById($id)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $sql = "SELECT v.*, ve.license_plate, ve.vehicle_type, u.full_name
            FROM violations v
            JOIN vehicles ve ON v.vehicle_id = ve.id
            JOIN users u ON ve.user_id = u.id
            WHERE v.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $violation = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $violation;
    }

    public static function updateStatus($id, $status)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $stmt = $conn->prepare("UPDATE violations SET status=? WHERE id=?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public static function searchByPlateAndStatus($plate, $status, $limit, $offset)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $sql = "SELECT v.*, ve.license_plate FROM violations v
            JOIN vehicles ve ON v.vehicle_id = ve.id
            WHERE 1";
        $params = [];
        $types = "";

        if ($plate) {
            $sql .= " AND ve.license_plate LIKE ?";
            $params[] = '%' . $plate . '%';
            $types .= "s";
        }
        if ($status) {
            $sql .= " AND v.status = ?";
            $params[] = $status;
            $types .= "s";
        }
        $sql .= " ORDER BY v.violation_time DESC LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        $types .= "ii";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $rows;
    }

    public static function countByPlateAndStatus($plate, $status)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $sql = "SELECT COUNT(*) as total FROM violations v
            JOIN vehicles ve ON v.vehicle_id = ve.id
            WHERE 1";
        $params = [];
        $types = "";

        if ($plate) {
            $sql .= " AND ve.license_plate LIKE ?";
            $params[] = '%' . $plate . '%';
            $types .= "s";
        }
        if ($status) {
            $sql .= " AND v.status = ?";
            $params[] = $status;
            $types .= "s";
        }

        $stmt = $conn->prepare($sql);
        if ($params) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $row['total'] ?? 0;
    }

    public static function countAll()
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $sql = "SELECT COUNT(*) as total FROM violations";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return $row['total'] ?? 0;
    }

    public static function countByStatus($status)
    {
        require_once 'models/db.php';
        $conn = connectDB();
        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM violations WHERE status = ?");
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $row['total'] ?? 0;
    }
}