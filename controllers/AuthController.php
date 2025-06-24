<?php
require_once 'models/User.php';

class AuthController
{
    public function login()
    {
        // Nếu là POST (AJAX fetch)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Chỉ cho phép tài khoản admin đăng nhập
            $user = User::findAdmin($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $user['username'];
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'redirect' => 'index.php?url=admin/dashboard'
                ]);
                exit;
            } else {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'error' => 'Sai tài khoản hoặc mật khẩu, hoặc bạn không có quyền truy cập!'
                ]);
                exit;
            }
        }

        // Nếu là GET, hiển thị form
        $error = '';
        include 'views/login.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php?url=login');
        exit;
    }

    public function register()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $error = "Vui lòng điền đầy đủ thông tin!";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                // Kiểm tra xem tên đăng nhập đã tồn tại chưa
                $existingUser = User::findByUsername($username);
                if ($existingUser) {
                    $error = "Tên đăng nhập đã tồn tại!";
                } else {
                    $error = "Đăng ký thành công!";
                    $user = User::create([
                        'username' => $username,
                        'password' => $hashedPassword
                    ]);
                    header("Location: index.php?url=login");
                }
                // echo $error;

                // Giả sử bạn có một phương thức để lưu người dùng mới vào cơ sở dữ liệu

                // exit;
            }
        }
        include 'views/register.php';
    }
}