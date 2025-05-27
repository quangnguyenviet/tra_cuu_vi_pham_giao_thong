<div id="approvals" class="section">
    <h2>✅ Phê duyệt Trạng thái Xử phạt</h2>
    <form>
        <div class="form-group">
            <label for="violationIdToApprove">Mã Vi phạm:</label>
            <input type="text" id="violationIdToApprove" name="violationIdToApprove"
                placeholder="Nhập mã vi phạm cần cập nhật">
        </div>
        <div class="form-group">
            <label for="statusUpdate">Cập nhật trạng thái:</label>
            <select id="statusUpdate" name="statusUpdate">
                <option value="chua-xu-ly">Chưa xử lý</option>
                <option value="da-xu-ly">Đã xử lý</option>
                <option value="da-thanh-toan">Đã thanh toán</option>
                <option value="huy-bo">Hủy bỏ</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật Trạng thái</button>
    </form>

    <h3>Vi phạm chờ phê duyệt/cập nhật</h3>
    <table>
        <thead>
            <tr>
                <th>Mã VP</th>
                <th>Biển số</th>
                <th>Lỗi vi phạm</th>
                <th>Trạng thái hiện tại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>VP001</td>
                <td>30A-123.45</td>
                <td>Vượt đèn đỏ</td>
                <td><span class="status-chua-xu-ly">Chưa xử lý</span></td>
                <td>
                    <select>
                        <option value="">Chọn trạng thái</option>
                        <option value="da-xu-ly">Đã xử lý</option>
                        <option value="da-thanh-toan">Đã thanh toán</option>
                        <option value="huy-bo">Hủy bỏ</option>
                    </select>
                    <button class="btn">Cập nhật</button>
                </td>
            </tr>
            <tr>
                <td>VP002</td>
                <td>51F-678.90</td>
                <td>Đi sai làn đường</td>
                <td><span class="status-da-xu-ly">Đã xử lý</span></td>
                <td>
                    <select>
                        <option value="">Chọn trạng thái</option>
                        <option value="da-thanh-toan">Đã thanh toán</option>
                        <option value="huy-bo">Hủy bỏ</option>
                    </select>
                    <button class="btn">Cập nhật</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>