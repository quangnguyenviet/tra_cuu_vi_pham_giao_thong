<div id="violations" class="section">
    <h2>🚨 Quản lý Dữ liệu Vi phạm</h2>
    <form id="violationForm" method="POST" action="index.php?url=admin/violations" enctype="multipart/form-data" >
        <div class="flex-row">
            <div class="form-group">
                <label for="violationPlate">Biển số xe:</label>
                <input type="text" id="violationPlate" name="violationPlate" placeholder="Ví dụ: 30A-123.45">
            </div>
            <div class="form-group">
                <label for="violationDate">Thời gian vi phạm:</label>
                <input type="date" id="violationDate" name="violationDate">
            </div>
            <div class="form-group">
                <label for="violationTime">Giờ vi phạm:</label>
                <input type="time" id="violationTime" name="violationTime">
            </div>
        </div>
        <div class="form-group">
            <label for="violationLocation">Địa điểm:</label>
            <input type="text" id="violationLocation" name="violationLocation"
                placeholder="Ví dụ: Ngã tư X, Đường Y, Quận Z">
        </div>
        <div class="form-group">
            <label for="violationType">Lỗi vi phạm:</label>
            <textarea id="violationType" name="violationType"
                placeholder="Mô tả chi tiết lỗi vi phạm, ví dụ: Vượt đèn đỏ"></textarea>
        </div>
        <div class="form-group">
            <label for="violationFine">Mức phạt (VND):</label>
            <input type="number" id="violationFine" name="violationFine" placeholder="Ví dụ: 500000">
        </div>
        <div class="form-group">
            <label for="violationImage">Hình ảnh/Video liên quan:</label>
            <input type="file" id="violationImage" name="violationImage" accept="image/*,video/*">
        </div>
        <button type="button" class="btn btn-primary">Thêm Vi phạm Mới</button>
        <button type="button" class="btn btn-danger">Xóa Vi phạm Đã Chọn</button>
    </form>

    <script>
        // xử lý sự kiện khi nhấn nút "Thêm Vi phạm Mới"
        document.querySelector('.btn-primary').addEventListener('click', function () {
            const form = document.getElementById('violationForm');
            const formData = new FormData(form);

            // Gửi dữ liệu đến server (giả sử có endpoint xử lý)
            fetch('index.php?url=admin/violations', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // Xử lý phản hồi từ server
                    if (data.success) {
                        alert('Vi phạm đã được thêm thành công!');
                        // Có thể làm mới danh sách vi phạm hoặc cập nhật giao diện
                    } else {
                        alert('Lỗi: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Đã xảy ra lỗi khi thêm vi phạm!');
                });
        });

    </script>

    <h3>Danh sách Vi phạm đã thêm gần đây</h3>
    <table>
        <thead>
            <tr>
                <th><input type="checkbox"></th>
                <th>Biển số</th>
                <th>Lỗi vi phạm</th>
                <th>Thời gian</th>
                <th>Địa điểm</th>
                <th>Mức phạt</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <!-- <tbody>
            <tr>
                <td><input type="checkbox"></td>
                <td>30A-123.45</td>
                <td>Vượt đèn đỏ</td>
                <td>20/05/2025 10:30</td>
                <td>Ngã tư Hai Bà Trưng - Lý Thường Kiệt</td>
                <td>500.000</td>
                <td><span class="status-chua-xu-ly">Chưa xử lý</span></td>
                <td>
                    <button class="btn">Sửa</button>
                    <button class="btn btn-danger">Xóa</button>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>51F-678.90</td>
                <td>Đi sai làn đường</td>
                <td>18/05/2025 09:15</td>
                <td>Đường X, Quận Y</td>
                <td>350.000</td>
                <td><span class="status-da-xu-ly">Đã xử lý</span></td>
                <td>
                    <button class="btn">Sửa</button>
                    <button class="btn btn-danger">Xóa</button>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>29C-000.00</td>
                <td>Đỗ xe sai quy định</td>
                <td>15/05/2025 14:00</td>
                <td>Phố đi bộ Hồ Gươm</td>
                <td>700.000</td>
                <td><span class="status-da-thanh-toan">Đã thanh toán</span></td>
                <td>
                    <button class="btn">Sửa</button>
                    <button class="btn btn-danger">Xóa</button>
                </td>
            </tr>
        </tbody> -->

        <tbody>
            <?php if (!empty($latestViolations))
                foreach ($latestViolations as $violation): ?>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><?= htmlspecialchars($violation['license_plate']) ?></td>
                        <td><?= htmlspecialchars($violation['violation_type']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($violation['violation_time'])) ?></td>
                        <td><?= htmlspecialchars($violation['location']) ?></td>
                        <td><?= number_format($violation['fine_amount']) ?></td>
                        <td><span><?= htmlspecialchars($violation['status']) ?></span></td>
                        <td>
                            <button class="btn">Sửa</button>
                            <button class="btn btn-danger">Xóa</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>