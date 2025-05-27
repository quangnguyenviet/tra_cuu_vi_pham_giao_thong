<?php
require_once 'models/Violation.php'; // Đảm bảo đã bao gồm model Violation
require_once 'models/Vehicle.php'; // Đảm bảo đã bao gồm model Vehicle
class ViolationsController
{
    public function index()
    {
        
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
        }
        else {            
            

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
                'image' => $violationImage ? $violationImage['name'] : null
            ];
            Violation::create($data);
            
        
          


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
}