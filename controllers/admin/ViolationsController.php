<?php
require_once 'models/Violation.php'; // Đảm bảo đã bao gồm model Violation
require_once 'models/Vehicle.php'; // Đảm bảo đã bao gồm model Vehicle
class ViolationsController
{
    public function index()
    {
        $latestViolations = Violation::getLatest(5);
        ob_start(); // Bắt đầu bộ đệm đầu ra
        $title = 'Trang quản lý vi phạm'; // Tiêu đề trang, có thể được thay đổi từ controller
        include 'views/admin/violations.php';
        $content = ob_get_clean(); // Lấy nội dung đã được bao gồm

        include 'views/layouts/admin.php';
    }
    public function store()
    {
        // lấy dữ liệu từ form
        $violationPlate = $_POST['violationPlate'] ?? '';
        $violationDate = $_POST['violationDate'] ?? '';
        $violationTime = $_POST['violationTime'] ?? '';
        $violationLocation = $_POST['violationLocation'] ?? '';
        $violationType = $_POST['violationType'] ?? '';
        $violationFine = $_POST['violationFine'] ?? '';
        $violationImage = $_FILES['violationImage'] ?? null;



        // Kiểm tra dữ liệu hợp lệ
        if (
            empty($violationPlate) || empty($violationDate) || empty($violationTime) ||
            empty($violationLocation) || empty($violationType) || empty($violationFine)
        ) {
            // Nếu có trường nào đó rỗng, trả về thông báo lỗi
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Vui lòng điền đầy đủ thông tin vi phạm!'
            ]);
            exit;
        } else {
            // Xử lý upload file nếu có
            if ($violationImage && $violationImage['error'] === UPLOAD_ERR_OK) {
                $targetDir = "uploads/violations/";
                if (!is_dir($targetDir))
                    mkdir($targetDir, 0777, true);
                $fileName = time() . '_' . basename($violationImage['name']);
                $targetFile = $targetDir . $fileName;
                if (move_uploaded_file($violationImage['tmp_name'], $targetFile)) {
                    $image_url = $targetFile;
                }
            }

            // Kiểm tra biển số xe có tồn tại không
            $vehicle = Vehicle::findByPlate($violationPlate);
            if (!$vehicle) {
                // Nếu không tìm thấy xe, trả về thông báo lỗi
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => 'Biển số xe không tồn tại!'
                ]);
                exit;
            }

            $data = [
                'vehicle_id' => $vehicle['id'],
                'date' => $violationDate,
                'time' => $violationTime,
                'location' => $violationLocation,
                'type' => $violationType,
                'fine' => $violationFine,
                'image' => $image_url
            ];
            $result = Violation::create($data);





            // Trả về phản hồi thành công
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Vi phạm đã được thêm thành công!'
            ]);
        }



        // Xử lý lưu vi phạm mới
        // Giả sử bạn đã có logic để lưu vi phạm vào cơ sở dữ liệu
        // Sau khi lưu xong, chuyển hướng về trang danh sách vi phạm
        // header("Location: index.php?url=admin/violations");
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id)
            die('Thiếu ID vi phạm');
        $violation = Violation::findById($id);
        ob_start();
        include 'views/admin/violation_edit.php';
        $content = ob_get_clean();
        include 'views/layouts/admin.php';
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;
        if (!$id)
            die('Thiếu ID vi phạm');
        // Xử lý upload ảnh nếu có
        $image_url = $_POST['old_image_url'] ?? '';
        if (isset($_FILES['violationImage']) && $_FILES['violationImage']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "uploads/violations/";
            if (!is_dir($targetDir))
                mkdir($targetDir, 0777, true);
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
            'image_url' => $image_url
        ];
        Violation::update($id, $data);
        header('Location: index.php?url=admin/violations');
        exit;
    }
}