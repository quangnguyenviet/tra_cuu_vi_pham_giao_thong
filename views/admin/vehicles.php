<!-- <div id="vehicles" class="section">
    <h2>🚗 Quản lý Phương tiện</h2>
    <form method="post">
        <div class="flex-row">
            <div class="form-group">
                <label for="vehiclePlate">Biển số xe:</label>
                <input type="text" id="vehiclePlate" name="vehiclePlate" placeholder="Ví dụ: 30A-123.45">
            </div>
            <div class="form-group">
                <label for="ownerName">Tên chủ sở hữu:</label>
                <input type="text" id="ownerName" name="ownerName" placeholder="Nguyễn Văn A">
            </div>
        </div>
        <div class="flex-row">
            <div class="form-group">
                <label for="ownerIdCard">Số CCCD chủ sở hữu:</label>
                <input type="text" id="ownerIdCard" name="ownerIdCard" placeholder="012345678910">
            </div>
            <div class="form-group">
                <label for="vehicleType">Loại xe:</label>
                <input type="text" id="vehicleType" name="vehicleType" placeholder="Ví dụ: Xe ô tô con, Xe máy">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật Thông tin Phương tiện</button>
    </form>

    <h3>Danh sách Phương tiện</h3>
    <table>
        <thead>
            <tr>
                <th>Biển số</th>
                <th>Chủ sở hữu</th>
                <th>Số CCCD</th>
                <th>Loại xe</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>30A-123.45</td>
                <td>Nguyễn Văn A</td>
                <td>012345678910</td>
                <td>Xe ô tô con</td>
                <td>
                    <button class="btn">Sửa</button>
                    <button class="btn btn-danger">Xóa</button>
                </td>
            </tr>
            <tr>
                <td>51F-678.90</td>
                <td>Trần Thị B</td>
                <td>098765432109</td>
                <td>Xe máy</td>
                <td>
                    <button class="btn">Sửa</button>
                    <button class="btn btn-danger">Xóa</button>
                </td>
            </tr>
        </tbody>
    </table>
</div> -->




<div id="vehicles" class="section">
    <h2>🚗 Quản lý Phương tiện</h2>
    <form method="post" action="index.php?url=admin/vehicles">
        <div class="flex-row">
            <div class="form-group">
                <label for="vehiclePlate">Biển số xe:</label>
                <input type="text" id="vehiclePlate" name="vehiclePlate" required>
            </div>
            <div class="form-group">
                <label for="chassisNumber">Số khung:</label>
                <input type="text" id="chassisNumber" name="chassisNumber" required>
            </div>
            <div class="form-group">
                <label for="ownerCccd">Số CCCD chủ sở hữu:</label>
                <input type="text" id="ownerCccd" name="ownerCccd" required>
            </div>
            <div class="form-group">
                <label for="vehicleType">Loại xe:</label>
                <input type="text" id="vehicleType" name="vehicleType" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm phương tiện</button>
    </form>
    <h3>Danh sách phương tiện</h3>
    <table>
        <thead>
            <tr>
                <th>Biển số</th>
                <th>Số khung</th>
                <th>Chủ sở hữu</th>
                <th>Loại xe</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($vehicles))
                foreach ($vehicles as $v): ?>
                    <tr>
                        <td><?= htmlspecialchars($v['license_plate']) ?></td>
                        <td><?= htmlspecialchars($v['chassis_number']) ?></td>
                        <td><?= htmlspecialchars($v['full_name']) ?></td>
                        <td><?= htmlspecialchars($v['vehicle_type']) ?></td>
                        <td><?= htmlspecialchars($v['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>