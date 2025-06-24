<?php
require_once 'models/Violation.php'; // Đảm bảo đã bao gồm model Violation
require_once 'models/Vehicle.php'; // Đảm bảo đã bao gồm model Vehicle
class ViolationsController
{


    // danh sách vi phạm
    public function index()
    {
        $limit = 10;
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $offset = ($page - 1) * $limit;

        $search_plate = $_GET['search_plate'] ?? '';
        $search_status = $_GET['search_status'] ?? '';

        if ($search_plate || $search_status) {
            $latestViolations = Violation::searchByPlateAndStatus($search_plate, $search_status, $limit, $offset);
            $total = Violation::countByPlateAndStatus($search_plate, $search_status);
        } else {
            $latestViolations = Violation::getPaged($limit, $offset);
            $total = Violation::countAll();
        }
        $totalPages = ceil($total / $limit);

        ob_start();
        include 'views/admin/violations.php';
        $content = ob_get_clean();
        include 'views/layouts/admin.php';
    }


    // hiển thị ra form thêm vi phạm
    public function add_view()
    {
        $title = 'Thêm vi phạm mới';
        ob_start();
        include 'views/admin/violation_add.php'; // Tạo file này để chứa form thêm vi phạm
        $content = ob_get_clean();
        include 'views/layouts/admin.php';
    }

    // lưu vi phạm mới
    public function store()
    {
        // Lấy dữ liệu từ form
        $license_plate = $_POST['violationPlate'] ?? '';
        $violation_date = $_POST['violationDate'] ?? '';
        $violation_time = $_POST['violationTime'] ?? '';
        $location = $_POST['violationLocation'] ?? '';
        $violation_type = $_POST['violationType'] ?? '';
        $fine_amount = $_POST['violationFine'] ?? 0;
        $regulation = $_POST['regulation'] ?? '';
        $regulation_desc = $_POST['regulationDesc'] ?? '';
        $additional_penalty = $_POST['additionalPenalty'] ?? '';
        $deadline = $_POST['deadline'] ?? null;
        $expected_fine_from = $_POST['expectedFineFrom'] ?? null;
        $expected_fine_to = $_POST['expectedFineTo'] ?? null;

        // Xử lý file upload (nếu có)
        $image_url = null;
        if (isset($_FILES['violationImage']) && $_FILES['violationImage']['error'] == UPLOAD_ERR_OK) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir))
                mkdir($target_dir, 0777, true);
            $target_file = $target_dir . time() . "_" . basename($_FILES["violationImage"]["name"]);
            if (move_uploaded_file($_FILES["violationImage"]["tmp_name"], $target_file)) {
                $image_url = $target_file;
            }
        }

        // Tìm vehicle_id từ biển số xe
        require_once 'models/Vehicle.php';
        $vehicle = Vehicle::findByPlate($license_plate);
        if (!$vehicle) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Biển số xe không tồn tại!'
            ]);
            exit;
        } else {
            $vehicle_id = $vehicle['id'];
        }

        // Ghép ngày và giờ
        $violation_datetime = $violation_date . ' ' . $violation_time . ':00';

        // Thêm vi phạm vào DB
        require_once 'models/Violation.php';
        $result = Violation::create([
            'vehicle_id' => $vehicle_id,
            'violation_time' => $violation_datetime,
            'location' => $location,
            'violation_type' => $violation_type,
            'fine_amount' => $fine_amount,
            'status' => 'chưa nộp phạt',
            'image_url' => $image_url,
            'regulation' => $regulation,
            'regulation_desc' => $regulation_desc,
            'additional_penalty' => $additional_penalty,
            'deadline' => $deadline,
            'expected_fine_from' => $expected_fine_from,
            'expected_fine_to' => $expected_fine_to,
            'created_at' => date('Y-m-d H:i:s')
        ]);


        if ($result) {
            header('Content-Type: application/json');

            echo json_encode(['success' => true]);
        } else {
            header('Content-Type: application/json');

            echo json_encode(['success' => false, 'message' => 'Không thể thêm vi phạm']);
        }
        exit;
    }

    // hiển thị ra form sửa vi phạm
    public function edit()
{
    $id = $_GET['id'] ?? null;
    if (!$id) die('Thiếu ID vi phạm');
    $violation = Violation::findById($id);
    ob_start();
    include 'views/admin/violation_edit.php';
    $content = ob_get_clean();
    include 'views/layouts/admin.php';
}

    // thực hiện cập nhật vi phạm
    public function update()
{
    $id = $_POST['id'] ?? null;
    if (!$id) die('Thiếu ID vi phạm');

    // Xử lý upload ảnh nếu có
    $image_url = $_POST['old_image_url'] ?? '';
    if (isset($_FILES['violationImage']) && $_FILES['violationImage']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $fileName = time() . '_' . basename($_FILES['violationImage']['name']);
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES['violationImage']['tmp_name'], $targetFile)) {
            $image_url = $targetFile;
        }
    }

    $data = [
        'violation_time' => $_POST['violation_time'],
        'location' => $_POST['location'],
        'violation_type' => $_POST['violation_type'],
        'fine_amount' => $_POST['fine_amount'],
        'status' => $_POST['status'],
        'image_url' => $image_url,
        'regulation' => $_POST['regulation'],
        'regulation_desc' => $_POST['regulation_desc'],
        'additional_penalty' => $_POST['additional_penalty'],
        'deadline' => $_POST['deadline'],
        'expected_fine_from' => $_POST['expected_fine_from'],
        'expected_fine_to' => $_POST['expected_fine_to'],
    ];

    Violation::update($id, $data);
    header('Location: index.php?url=admin/violations');
    exit;
}

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Thiếu ID vi phạm']);
            exit;
        }

        require_once 'models/Violation.php';
        $result = Violation::delete($id);

        header('Content-Type: application/json');
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Xóa vi phạm thất bại']);
        }
        exit;
    }
}