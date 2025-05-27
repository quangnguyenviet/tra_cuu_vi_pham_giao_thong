<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo isset($title) ? $title : 'Admin Dashboard'; ?><!-- Tiêu đề trang, có thể được thay đổi từ controller -->
    </title>
    <link rel="stylesheet" href="assets/css/layout/admin.css"> <!-- Đường dẫn đến file CSS -->
</head>

<body>

    <div class="sidebar">
        <div class="logo">
            <a href="#">Admin Dashboard</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php?url=admin/dashboard" class="active">📊 Tổng quan</a></li>
                <!-- Thêm class js-link cho các link cần load động -->
                <li><a href="index.php?url=admin/violations">🚨 Quản lý Vi phạm</a></li>
                <li><a href="index.php?url=admin/vehicles">🚗 Quản lý Phương tiện</a></li>
                <li><a href="index.php?url=admin/approvals">✅ Phê duyệt Xử phạt</a></li>
                <!-- <li><a href="users">👥 Quản lý Người dùng</a></li> -->
                <!-- <li><a href="setting">⚙️ Cài đặt</a></li> -->
                <li><a href="logout">🚪 Đăng xuất</a></li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <?php
        if (isset($content)) {
            echo $content; // Nội dung chính của trang sẽ được hiển thị ở đây
        } else {
            echo "<h1>Chào mừng đến với trang quản trị!</h1>";
        }
        ?>

    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarLinks = document.querySelectorAll('.sidebar nav ul li a');

            // Đặt link active dựa trên URL khi tải trang
            const currentUrl = new URL(window.location.href);
            const currentParam = currentUrl.searchParams.get('url');

            sidebarLinks.forEach(link => {
                // Lấy giá trị url từ href của từng link
                console.log(link.href);
                const linkUrl = new URL(link.href, window.location.origin);
                const linkParam = linkUrl.searchParams.get('url');
                // console.log(linkParam, currentParam);
                if (linkParam === currentParam) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }

                // Xử lý active khi click
                link.addEventListener('click', function (e) {
                    sidebarLinks.forEach(item => item.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>




    

</body>

</html>