<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tra Cứu Vi Phạm Giao Thông</title>
    <link rel="stylesheet" href="assets/css/layout/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <?php
    // Giả sử bạn đặt biến $page hoặc $title ở controller
    if (isset($page) && $page === 'home') {
        echo '<link rel="stylesheet" href="assets/css/home.css">';
    }
    if (isset($page) && $page === 'search') {
        echo '<link rel="stylesheet" href="assets/css/home.css">';
    }
    if (isset($page) && $page === 'violation_detail') {
        echo '<link rel="stylesheet" href="assets/css/violation_detail.css">';
    }
    if (isset($page) && $page === 'payment') {
        echo '<link rel="stylesheet" href="assets/css/payment.css">';
    }

    ?>

</head>

<body>
    <header>
        <div class="container-custom">
            <div class="logo">
                <i class="fas fa-car-burst"></i>
            </div>
            <h1>Tra Cứu Vi Phạm Giao Thông</h1>
        </div>
    </header>
    <main class="container-custom">

        <nav aria-label="breadcrumb" class="breadcrumb" style="margin-bottom: 18px;">
            <?php
            if (isset($page) && $page === 'home') {
                echo '<a href="index.php?url=home"><i class="fas fa-home"></i> Trang chủ</a>';
            } elseif (isset($page) && $page === 'search') {
                echo '<a href="index.php?url=home"><i class="fas fa-home"></i> Trang chủ</a>';
                echo '<span> / </span>';
                echo '<span>Tìm kiếm thông tin vi phạm</span>';
            } elseif (isset($page) && $page === 'violation_detail') {
                echo '<a href="index.php?url=home"><i class="fas fa-home"></i> Trang chủ</a>';

                // Nếu có bien_so trên URL thì nối tiếp breadcrumb
                if (isset($_GET['bien_so']) && $_GET['bien_so'] !== '') {
                    echo '<span> / </span>';
                    echo '<a href="index.php?url=search&bien_so=' . urlencode($_GET['bien_so']) . '">Tìm kiếm thông tin vi phạm</a>';
                }
                echo '<span> / </span>';
                echo '<span>Chi tiết vi phạm #' . htmlspecialchars($violation['id']) . '</span>';
            }
            ?>
        </nav>



        </nav>
        <?= $content ?>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2025 Trung Tâm Xử Lý Vi Phạm Giao Thông. Bảo lưu mọi quyền.</p>
            <p>Liên hệ: support@giaothong.gov.vn | Hotline: 1900 xxxx</p>
        </div>
    </footer>
</body>

</html>