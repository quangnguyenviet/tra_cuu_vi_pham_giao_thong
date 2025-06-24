<?php
session_start();

$url = $_GET['url'] ?? '';

// Hàm kiểm tra quyền
function requireAdmin() {
    if (empty($_SESSION['admin_logged_in'])) {
        header('Location: index.php?url=login');
        exit;
    }
}

switch ($url) {
    // hiển thị trang chủ
    case '':
    case 'home':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;

    // xử lý tra cứu theo biển số
    case 'search':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController();
        $controller->search();
        break;
    case 'login':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
        break;

    case 'logout':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'dashboard':
        require 'views/dashboard.php';
        break;

    case 'register':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        $controller->register();
        break;
    case 'admin/dashboard':
        
        requireAdmin(); // Kiểm tra quyền admin
        require_once 'controllers/admin/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();

        break;
    case 'admin/violations':
        
        requireAdmin(); // Kiểm tra quyền admin
        require_once 'controllers/admin/ViolationsController.php';
        $controller = new ViolationsController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->store();
        } else {
            $controller->index();
        }
        break;
    // hiển thị ra form thêm vi phạm
    case 'admin/violations_add':
        requireAdmin(); // Kiểm tra quyền admin
        require_once 'controllers/admin/ViolationsController.php';
        $controller = new ViolationsController();
        $controller->add_view();
        break;
    case 'admin/vehicles':
        requireAdmin(); // Kiểm tra quyền admin
        require_once 'controllers/admin/VehiclesController.php';
        $controller = new VehiclesController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->store();
        } else {
            $controller->index();
        }
        break;
    // case 'admin/approvals':
    //     // requireRole('admin');
    //     require_once 'controllers/admin/ApprovalsController.php';
    //     $controller = new ApprovalsController();
    //     $controller->index();
    //     break;
    case 'admin/violations_edit':
        requireAdmin(); // Kiểm tra quyền admin
        require_once 'controllers/admin/ViolationsController.php';
        $controller = new ViolationsController();
        $controller->edit();
        break;

    case 'admin/violations_update':
        requireAdmin(); // Kiểm tra quyền admin
        require_once 'controllers/admin/ViolationsController.php';
        $controller = new ViolationsController();
        $controller->update();
        break;

    // hiển thi trang chi tiết vi phạm
    case 'violation_detail':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController();
        $controller->violationDetail();
        break;

    // xử lý nộp phạt cần id của vi phạm
    case 'payment':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController();
        $controller->payment();
        break;
    // zalo pay callback
    case 'zalopay_callback':
        require_once 'controllers/zalopay_callback.php';
        break;

    case 'admin/violations_delete':
        requireAdmin(); // Kiểm tra quyền admin
        require_once 'controllers/admin/ViolationsController.php';
        $controller = new ViolationsController();
        $controller->delete();
        break;
    default:
        echo "404 - Không tìm thấy trang.";
        break;
}
?>