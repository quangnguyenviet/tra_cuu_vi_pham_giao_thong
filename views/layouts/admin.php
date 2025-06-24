<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo isset($title) ? $title : 'Admin Dashboard'; ?><!-- Tiêu đề trang, có thể được thay đổi từ controller -->
    </title>
    <link rel="stylesheet" href="assets/css/layout/admin.css"> <!-- Đường dẫn đến file CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

<div class="sidebar">
    <div class="logo">
        <a href="index.php?url=admin/dashboard"><i class="fas fa-shield-alt"></i> Admin Dashboard</a>
    </div>
    <nav>
        <ul>
            <li><a href="index.php?url=admin/dashboard"><i class="fas fa-chart-pie"></i> Tổng quan</a></li>
            <li class="has-submenu">
                <a href="javascript:void(0);" class="toggle-submenu"><i class="fas fa-exclamation-triangle"></i> Quản lý vi phạm <span class="arrow">&#9662;</span></a>
                <ul class="submenu">
                    <li><a href="index.php?url=admin/violations_add"><i class="fas fa-plus-circle"></i> Thêm vi phạm</a></li>
                    <li><a href="index.php?url=admin/violations"><i class="fas fa-list"></i> Danh sách vi phạm</a></li>
                </ul>
            </li>
            <li><a href="index.php?url=admin/vehicles"><i class="fas fa-car"></i> Quản lý Phương tiện</a></li>
            <li><a href="index.php?url=logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
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


            // Toggle submenu for "Quản lý vi phạm"
            const toggleMenu = document.querySelector('.toggle-submenu');
            const submenu = document.querySelector('.submenu');
            if (toggleMenu && submenu) {
                toggleMenu.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (submenu.style.display === 'none' || submenu.style.display === '') {
                        submenu.style.display = 'block';
                    } else {
                        submenu.style.display = 'none';
                    }
                });
            }
        });
    </script>






</body>

</html>