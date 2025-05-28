
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username varchar(30) unique,
  full_name NVARCHAR(255),
  email NVARCHAR(255) UNIQUE,
  password NVARCHAR(255),
  phone NVARCHAR(20),
  created_at DATETIME,
  cccd varchar(255),
  role NVARCHAR(50)
);

-- ==== Phương tiện ====
CREATE TABLE vehicles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  license_plate NVARCHAR(50) UNIQUE COMMENT 'Biển số xe',
  chassis_number NVARCHAR(100) COMMENT 'Số khung',
  user_id INT COMMENT 'Chủ sở hữu',
  created_at DATETIME,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- ==== Vi phạm giao thông ====
CREATE TABLE violations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  vehicle_id INT,
  violation_time DATETIME,
  location NVARCHAR(255),
  violation_type NVARCHAR(100),
  fine_amount DECIMAL(10, 2),
  status NVARCHAR(50) COMMENT 'Chưa xử lý, Đã xử lý, Đã thanh toán',
  image_url NVARCHAR(255),
  video_url NVARCHAR(255),
  created_at DATETIME,
  FOREIGN KEY (vehicle_id) REFERENCES vehicles(id)
);

-- ==== Thanh toán ====
CREATE TABLE payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  violation_id INT,
  payment_time DATETIME,
  amount DECIMAL(10, 2),
  payment_method NVARCHAR(50),
  transaction_id NVARCHAR(100),
  status NVARCHAR(50) COMMENT 'Thành công, Thất bại',
  FOREIGN KEY (violation_id) REFERENCES violations(id)
);

-- ==== Lịch sử vi phạm ====
CREATE TABLE violation_history (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  violation_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (violation_id) REFERENCES violations(id)
);
