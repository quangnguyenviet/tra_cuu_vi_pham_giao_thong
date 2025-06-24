<h2 class="form-title"><i class="fas fa-edit"></i> Sửa Vi phạm</h2>
<form method="post" action="index.php?url=admin/violations_update" enctype="multipart/form-data" class="violation-form">
    <input type="hidden" name="id" value="<?= $violation['id'] ?>">
    <input type="hidden" name="old_image_url" value="<?= htmlspecialchars($violation['image_url']) ?>">
    <div class="form-row">
        <div class="form-group">
            <label>Biển số xe:</label>
            <input type="text" value="<?= htmlspecialchars($violation['license_plate']) ?>" disabled>
        </div>
        <div class="form-group">
            <label>Thời gian vi phạm:</label>
            <input type="datetime-local" name="violation_time" value="<?= date('Y-m-d\TH:i', strtotime($violation['violation_time'])) ?>" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label>Địa điểm:</label>
            <input type="text" name="location" value="<?= htmlspecialchars($violation['location']) ?>" required>
        </div>
        <div class="form-group">
            <label>Lỗi vi phạm:</label>
            <input type="text" name="violation_type" value="<?= htmlspecialchars($violation['violation_type']) ?>" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label>Mức phạt:</label>
            <input type="number" name="fine_amount" value="<?= $violation['fine_amount'] ?>" required>
        </div>
        <div class="form-group">
            <label>Trạng thái:</label>
            <select name="status">
                <option value="chưa nộp phạt" <?= $violation['status'] === 'chưa nộp phạt' ? 'selected' : '' ?>>Chưa nộp phạt</option>
                <option value="Đã nộp phạt" <?= $violation['status'] === 'Đã nộp phạt' ? 'selected' : '' ?>>Đã nộp phạt</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label>Điều khoản áp dụng:</label>
            <input type="text" name="regulation" value="<?= htmlspecialchars($violation['regulation']) ?>">
        </div>
        <div class="form-group">
            <label>Hạn nộp phạt:</label>
            <input type="date" name="deadline" value="<?= $violation['deadline'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label>Mô tả điều khoản:</label>
        <textarea name="regulation_desc"><?= htmlspecialchars($violation['regulation_desc']) ?></textarea>
    </div>
    <div class="form-group">
        <label>Hình phạt bổ sung:</label>
        <input type="text" name="additional_penalty" value="<?= htmlspecialchars($violation['additional_penalty']) ?>">
    </div>
    <div class="form-row">
        <div class="form-group">
            <label>Mức phạt dự kiến từ:</label>
            <input type="number" name="expected_fine_from" value="<?= $violation['expected_fine_from'] ?>">
        </div>
        <div class="form-group">
            <label>Mức phạt dự kiến đến:</label>
            <input type="number" name="expected_fine_to" value="<?= $violation['expected_fine_to'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label>Hình ảnh/Video liên quan:</label>
        <?php if ($violation['image_url']): ?>
            <img src="<?= htmlspecialchars($violation['image_url']) ?>" alt="Ảnh vi phạm" style="max-width:120px;display:block;margin-bottom:8px;">
        <?php endif; ?>
        <input type="file" name="violationImage" accept="image/*,video/*">
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật</button>
</form>

<!-- Font Awesome CDN nếu chưa có -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
.violation-form {
    background: #fff;
    border-radius: 10px;
    padding: 32px 28px 22px 28px;
    max-width: 800px;
    margin: 32px auto 0 auto;
    box-shadow: 0 4px 24px rgba(0,0,0,0.07);
}
.form-title {
    text-align: center;
    color: #00509e;
    margin-bottom: 28px;
    font-size: 2em;
    font-weight: 600;
}
.form-row {
    display: flex;
    gap: 18px;
    flex-wrap: wrap;
}
.form-group {
    flex: 1 1 220px;
    margin-bottom: 18px;
    display: flex;
    flex-direction: column;
}
.form-group label {
    font-weight: 500;
    margin-bottom: 6px;
    color: #00509e;
    display: flex;
    align-items: center;
    gap: 6px;
}
.form-group input[type="text"],
.form-group input[type="number"],
.form-group input[type="date"],
.form-group input[type="time"],
.form-group input[type="file"],
.form-group input[type="datetime-local"],
.form-group textarea,
.form-group select {
    padding: 8px 10px;
    border: 1px solid #b7c6d9;
    border-radius: 5px;
    font-size: 1em;
    background: #f8fafc;
    transition: border 0.2s;
}
.form-group input[type="file"] {
    background: #fff;
    border: none;
}
.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    border-color: #00509e;
    outline: none;
}
.form-group textarea {
    min-height: 60px;
    resize: vertical;
}
.btn.btn-primary {
    background: #00509e;
    color: #fff;
    border: none;
    padding: 12px 32px;
    border-radius: 5px;
    font-size: 1.1em;
    font-weight: 500;
    cursor: pointer;
    margin-top: 10px;
    transition: background 0.2s;
    display: block;
    margin-left: auto;
    margin-right: auto;
}
.btn.btn-primary:hover {
    background: #003f7e;
}
@media (max-width: 800px) {
    .violation-form { padding: 18px 6px; }
    .form-row { flex-direction: column; gap: 0; }
}
</style>