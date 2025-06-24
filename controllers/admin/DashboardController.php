<?php
require_once 'models/Violation.php';
require_once 'models/Vehicle.php';
class DashboardController
{
    public function index()
    {

        $total_violations = Violation::countAll();
        $unpaid_violations = Violation::countByStatus('Chưa nộp phạt');
        $paid_violations = Violation::countByStatus('Đã nộp phạt');
        $total_vehicles = Vehicle::countAll();

        ob_start(); // Bắt đầu bộ đệm đầu ra
        include 'views/admin/home.php';
        $content = ob_get_clean(); // Lấy nội dung đã được bao gồm
        $title = 'Trang Quản Trị'; // Tiêu đề trang, có thể được thay đổi từ controller
        include 'views/layouts/admin.php';
    }
}