<?php
require_once 'models/User.php';

class AuthController
{
    public function login()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = User::findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id']; 
                header("Location: index.php?url=dashboard");
                
            } else {
                $error = "Sai tài khoản hoặc mật khẩu!";
            }
        }
        include 'views/login.php';
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