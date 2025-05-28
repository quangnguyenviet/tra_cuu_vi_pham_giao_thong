<?php
session_start();

$url = $_GET['url'] ?? 'login';

// Hàm kiểm tra quyền
function requireRole($role)
{
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        header("Location: index.php?url=login");
        exit;
    }
}

switch ($url) {
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
        // requireRole('admin');
        require_once 'controllers/admin/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();

        break;
    case 'admin/violations':
        // requireRole('admin');
        require_once 'controllers/admin/ViolationsController.php';
        $controller = new ViolationsController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->store();
        } else {
            $controller->index();
        }
        break;
    case 'admin/vehicles':
        require_once 'controllers/admin/VehiclesController.php';
        $controller = new VehiclesController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->store();
        } else {
            $controller->index();
        }
        break;
    case 'admin/approvals':
        // requireRole('admin');
        require_once 'controllers/admin/ApprovalsController.php';
        $controller = new ApprovalsController();
        $controller->index();
        break;
    case 'admin/violations_edit':
        require_once 'controllers/admin/ViolationsController.php';
        $controller = new ViolationsController();
        $controller->edit();
        break;

    case 'admin/violations_update':
        require_once 'controllers/admin/ViolationsController.php';
        $controller = new ViolationsController();
        $controller->update();
        break;
    default:
        echo "404 - Không tìm thấy trang.";
        break;
}
?>