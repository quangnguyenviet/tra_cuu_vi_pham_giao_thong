<?php

class VehiclesController{
    public function __construct() {
        // Initialization code, if needed
    }

    public function index() {
        
        ob_start(); // Bắt đầu bộ đệm đầu ra
        $title = 'Trang quản lý phương tiện'; // Tiêu đề trang, có thể được thay đổi từ controller
        include 'views/admin/vehicles.php';
        $content = ob_get_clean(); // Lấy nội dung đã được bao gồm
        
        include 'views/layouts/admin.php'; 

    }

    public function create() {
        // Code to show form for creating a new vehicle
    }

    public function store() {
        // Code to save a new vehicle
    }

    public function edit($id) {
        // Code to show form for editing an existing vehicle
    }

    public function update($id) {
        // Code to update an existing vehicle
    }

    public function delete($id) {
        // Code to delete a vehicle
    }
}