<?php
class ApprovalsController
{
    public function index()
    {
        ob_start(); // Bắt đầu bộ đệm đầu ra
        $title = 'Trang phê duyệt xử phạt'; // Tiêu đề trang, có thể được thay đổi từ controller
        include 'views/admin/approvals.php';
        $content = ob_get_clean(); // Lấy nội dung đã được bao gồm

        include 'views/layouts/admin.php';
    }

    // private function getApprovals() {
    //     // Giả lập dữ liệu, trong thực tế sẽ lấy từ cơ sở dữ liệu
    //     return [
    //         ['id' => 1, 'user' => 'Nguyen Van A', 'status' => 'pending'],
    //         ['id' => 2, 'user' => 'Tran Thi B', 'status' => 'approved'],
    //         ['id' => 3, 'user' => 'Le Van C', 'status' => 'rejected'],
    //     ];
    // }
}