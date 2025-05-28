
<h2>Sửa thông tin vi phạm</h2>
<form method="post" action="index.php?url=admin/violations_update" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $violation['id'] ?>">
    <input type="hidden" name="old_image_url" value="<?= htmlspecialchars($violation['image_url']) ?>">
    <div>
        <label>Thời gian vi phạm:</label>
        <input type="text" name="violation_time" value="<?= htmlspecialchars($violation['violation_time']) ?>" required>
    </div>
    <div>
        <label>Địa điểm:</label>
        <input type="text" name="location" value="<?= htmlspecialchars($violation['location']) ?>" required>
    </div>
    <div>
        <label>Lỗi vi phạm:</label>
        <input type="text" name="violation_type" value="<?= htmlspecialchars($violation['violation_type']) ?>" required>
    </div>
    <div>
        <label>Mức phạt:</label>
        <input type="number" name="fine_amount" value="<?= htmlspecialchars($violation['fine_amount']) ?>" required>
    </div>
    <div>
        <label>Trạng thái:</label>
        <input type="text" name="status" value="<?= htmlspecialchars($violation['status']) ?>" required>
    </div>
    <div>
        <label>Ảnh hiện tại:</label>
        <?php if ($violation['image_url']): ?>
            <img src="<?= $violation['image_url'] ?>" width="100">
        <?php endif; ?>
        <input type="file" name="violationImage">
    </div>
    <button type="submit">Cập nhật</button>
</form>