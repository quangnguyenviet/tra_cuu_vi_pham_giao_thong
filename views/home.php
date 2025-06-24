

<section class="search-section">
    <h2>Tìm kiếm thông tin vi phạm</h2>
    <form action="index.php" method="get" class="search-form">
        <input type="hidden" name="url" value="search">
        <input type="text" name="bien_so" placeholder="Nhập biển số xe (ví dụ: 29A12345)" required>
        <button type="submit"><i class="fas fa-search"></i>Tra Cứu</button>
    </form>
    <p style="margin-top: 15px; font-size: 0.9em; color: #666;">Vui lòng nhập chính xác biển số xe để nhận kết quả nhanh nhất.</p>
</section>

<section class="violations-list">
    <h2><i class="fas fa-list-ul"></i> Một số vi phạm ghi nhận gần đây</h2>
    <?php if (!empty($latestViolations)): ?>
        <?php foreach ($latestViolations as $violation): ?>
            <article class="violation-card">
                <h3><i class="fas fa-ban"></i> <?= htmlspecialchars($violation['violation_type']) ?></h3>
                <p><strong class="license-plate"><?= htmlspecialchars($violation['license_plate']) ?></strong></p>
                <p><strong>Thời gian:</strong> <?= date('H:i - d/m/Y', strtotime($violation['violation_time'])) ?></p>
                <p><strong>Địa điểm:</strong> <?= htmlspecialchars($violation['location']) ?></p>
                <div class="violation-footer">
                    <span class="status <?= $violation['status'] == 'chưa nộp phạt' ? 'pending' : ($violation['status'] == 'đã xử lý' ? 'resolved' : 'new') ?>">
                        <?= htmlspecialchars($violation['status']) ?>
                    </span>
                    <a href="index.php?url=violation_detail&id=<?= $violation['id'] ?>" class="details-link">Xem chi tiết <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Chưa có dữ liệu vi phạm.</p>
    <?php endif; ?>
</section>
