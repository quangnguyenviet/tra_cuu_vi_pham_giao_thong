<?php
require_once 'models/Violation.php';
require_once 'zalopay.php';

class HomeController
{
    // hiển thị trang chủ
    public function index()
    {
        // để lấy css cho trang home
        $page = "home";
        // Lấy 5 vi phạm mới nhất
        $latestViolations = Violation::getLatest(5);
        ob_start();
        include 'views/home.php';
        $content = ob_get_clean();
        include 'views/layouts/main.php'; // layout chính, nếu có
    }

    // Xử lý tra cứu theo biển số
    public function search()
    {
        // để lấy css cho trang search_result
        $page = "search";

        $bien_so = $_GET['bien_so'] ?? '';
        $violations = [];
        if ($bien_so) {
            $violations = Violation::findByPlate($bien_so);
        }
        ob_start();
        include 'views/search_result.php';
        $content = ob_get_clean();
        include 'views/layouts/main.php';
    }

    // Xem chi tiết vi phạm
    public function violationDetail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id)
            die('Thiếu ID vi phạm');
        $violation = Violation::findDetailById($id);

        // hỗ trợ lấy css cho violation_detail
        $page = 'violation_detail';
        ob_start();
        include 'views/violation_detail.php';
        $content = ob_get_clean();
        include 'views/layouts/main.php';
    }

    // Trang thanh toán
    public function payment()
    {
        $violation_id = $_GET['violation_id'] ?? null;
        if (!$violation_id)
            die('Thiếu mã vi phạm!');

        $violation = Violation::findDetailById($violation_id);

        // Tạo QR ZaloPay
        $zalopayOrder = createZaloPayOrder($violation['id'], $violation['fine_amount']);

        // url chuyển hướng đến trang thanh toán ZaloPay
        $qr_url = $zalopayOrder['order_url'] ?? null; 

        $qr_img = $zalopayOrder['zp_trans_token'] ?? null; // Có thể dùng để tạo QR code nếu muốn

        // hỗ trợ lấy css cho trang payment
        $page = 'payment';

        ob_start();
        include 'views/payment.php';
        $content = ob_get_clean();
        include 'views/layouts/main.php';


        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $violation_id = $_POST['violation_id'];
        //     $payer_name = $_POST['payer_name'];
        //     $payer_phone = $_POST['payer_phone'];
        //     $payer_email = $_POST['payer_email'];
        //     // ... kiểm tra dữ liệu, lấy thông tin vi phạm ...
        //     $violation = Violation::findDetailById($violation_id);

        //     // Tạo đơn hàng ZaloPay
        //     $zalopayOrder = createZaloPayOrder($violation['id'], $violation['fine_amount']);
        //     if (!empty($zalopayOrder['order_url'])) {
        //         echo '<h2>Đơn hàng ZaloPay đã được tạo thành công!</h2>';
        //         // Chuyển hướng sang trang thanh toán của ZaloPay
        //         // header('Location: ' . $zalopayOrder['order_url']);
        //         exit;
        //     } else {
        //         // Xử lý lỗi, ví dụ hiển thị thông báo
        //         die('Không tạo được đơn hàng ZaloPay: ' . ($zalopayOrder['error'] ?? 'Lỗi không xác định'));
        //     }
        // }
    }
}
