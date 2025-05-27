<?php
class DashboardController {
    public function index() {
        // Xử lý logic nếu cần
        ob_start(); // Bắt đầu bộ đệm đầu ra
        include 'views/admin/home.php';
        $content = ob_get_clean(); // Lấy nội dung đã được bao gồm
        $title = 'Trang Quản Trị'; // Tiêu đề trang, có thể được thay đổi từ controller
        include 'views/layouts/admin.php'; 
    }
}