<?php

function createZaloPayOrder(
    $order_id,
    $amount,
    $items = [], // Default to empty array, can be overridden
    $embeddata = [], // Default to empty array, can be overridden
) {

    $config = [
        "app_id" => 2553, // app_id của v2
        "key1" => "PcY4iZIKFCIdgZvA6ueMcMHHUbRLYjPL", // key1 của v2
        "endpoint" => "https://sb-openapi.zalopay.vn/v2/create",
        // url callback
        "callback_url" => "https://cd93-2001-ee0-1a5b-38c1-9080-9403-c957-5617.ngrok-free.app/tra_cuu_vi_pham_giao_thong/index.php?url=zalopay_callback", 
    ];

    $embeddata = '{}'; 
    $order = [
        "app_id" => $config["app_id"],
        "app_trans_id" => date("ymd").",".uniqid()."_".$order_id,
        "app_user" => "user_demo",
        "app_time" => round(microtime(true) * 1000), // Current time in milliseconds
        "amount" => (int) $amount, // Total amount for the order
        "item" => json_encode($items, JSON_UNESCAPED_UNICODE), // JSON encoded array of items
        "description" => "ZaloPay Intergration Demo", // Description of the order
        "embed_data" => $embeddata, 
        "bank_code" => "zalopayapp",
        "callback_url" => $config["callback_url"], // Callback URL for payment result
    ];

   

    $data = $order["app_id"] . "|" .
        $order["app_trans_id"] . "|" .
        $order["app_user"] . "|" .
        $order["amount"] . "|" .
        $order["app_time"] . "|" .
        $order["embed_data"] . "|" .
        $order["item"];
    $order["mac"] = hash_hmac("sha256", $data, $config["key1"]);

  
    // Tạo context cho HTTP request
    // "header" => "Content-type: application/x-www-form-urlencoded\r\n": khai báo kiểu dữ liệu gửi đi giống như khi gửi form HTML. Dữ liệu sẽ được mã hóa dưới dạng key1=value1&key2=value2.
    // http_build_query($order) chuyển mảng $order thành chuỗi URL-encoded

    $context = stream_context_create([
        "http" => [
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($order)
        ]
    ]);

    // Gửi request đến ZaloPay API
    // file_get_contents(...): thường dùng để đọc nội dung file, nhưng nếu cung cấp URL và context, nó sẽ thực hiện HTTP request đến URL đó.
    // resp kết quả trả vê từ ZaloPay API, thường là một JSON string chứa thông tin về đơn hàng đã tạo.
    $resp = file_get_contents($config["endpoint"], false, $context);
    
    // json_decode(..., true): chuyển chuỗi JSON trả về từ server thành mảng kết hợp PHP.
    $result = json_decode($resp, true);

    return $result;
    
}