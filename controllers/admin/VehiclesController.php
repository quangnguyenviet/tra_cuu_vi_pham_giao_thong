<?php
require_once 'models/Vehicle.php';
require_once 'models/User.php'; // Nếu cần lấy danh sách user cho select

class VehiclesController
{
    public function __construct()
    {
        // Initialization code, if needed
    }

    public function index()
    {
        $vehicles = Vehicle::getAll();
        // Lấy danh sách user để chọn chủ sở hữu
        $users = User::getAll(); // Bạn cần viết hàm getAll trong User.php
        ob_start();
        include 'views/admin/vehicles.php';
        $content = ob_get_clean();
        include 'views/layouts/admin.php';
    }

    public function create()
    {
        // Code to show form for creating a new vehicle
    }

    public function store()
    {
        require_once 'models/User.php';
        $cccd = $_POST['ownerCccd'] ?? '';
        $user = User::findByCccd($cccd); // Viết hàm này ở model User

        if (!$user) {
            // Xử lý khi không tìm thấy user
            // Có thể báo lỗi hoặc chuyển hướng lại với thông báo
            die('Không tìm thấy người dùng với số CCCD này!');
        }

        $data = [
            'license_plate' => $_POST['vehiclePlate'] ?? '',
            'chassis_number' => $_POST['chassisNumber'] ?? '',
            'user_id' => $user['id'],
            'vehicle_type' => $_POST['vehicleType'] ?? ''
        ];
        Vehicle::create($data);
        header('Location: index.php?url=admin/vehicles');
        exit;
    }

    public function edit($id)
    {
        // Code to show form for editing an existing vehicle
    }

    public function update($id)
    {
        // Code to update an existing vehicle
    }

    public function delete($id)
    {
        // Code to delete a vehicle
    }
}