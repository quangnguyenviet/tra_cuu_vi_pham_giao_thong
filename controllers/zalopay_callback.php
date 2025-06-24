<?php
require_once 'models/Violation.php';

$response = [
    "return_code" => 2,
    "return_message" => "Fail"
];

// Nhận dữ liệu JSON từ ZaloPay
// lấy dữ liệu json từ body của request
$data = file_get_contents('php://input');
// giải mã dữ liệu json
$json = json_decode($data, true);

// data bên trong json là một chuỗi JSON khác
$data = json_decode($json['data'], true);

// Lấy violation_id từ app_trans_id
$apptransid = $data['app_trans_id'];

// lấy id vi phạm
$parts = explode('_', $apptransid);
$violation_id = isset($parts[1]) ? $parts[1] : null;


if ($violation_id) {
    Violation::updateStatus($violation_id, 'Đã nộp phạt');
    $response = [
        "return_code" => 1,
        "return_message" => "Success"
    ];
}

// Trả về JSON theo yêu cầu ZaloPay
header('Content-Type: application/json');
echo json_encode($response);
