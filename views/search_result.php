<section class="search-section">
    <h2>Kết quả tra cứu vi phạm</h2>
    <form action="index.php?url=search" method="GET" class="search-form">
        <input type="text" name="bien_so" placeholder="Nhập biển số xe" value="<?= htmlspecialchars($_GET['bien_so'] ?? '') ?>" required>
        <button type="submit"><i class="fas fa-search"></i>Tra Cứu</button>
    </form>
</section>

<section class="violations-list">
    <?php if (!empty($violations)): ?>
        <?php foreach ($violations as $violation): ?>
            <article class="violation-card">
                <h3><i class="fas fa-ban"></i> <?= htmlspecialchars($violation['violation_type']) ?></h3>
                <p><strong class="license-plate"><?= htmlspecialchars($violation['license_plate']) ?></strong></p>
                <p><strong>Thời gian:</strong> <?= date('H:i - d/m/Y', strtotime($violation['violation_time'])) ?></p>
                <p><strong>Địa điểm:</strong> <?= htmlspecialchars($violation['location']) ?></p>
                <div class="violation-footer">
                    <span class="status <?= $violation['status'] == 'chưa xử lý' ? 'pending' : ($violation['status'] == 'đã xử lý' ? 'resolved' : 'new') ?>">
                        <?= htmlspecialchars($violation['status']) ?>
                    </span>
                    <a href="index.php?url=violation_detail&id=<?= $violation['id'] ?>&bien_so=<?= urlencode($_GET['bien_so']) ?>" class="details-link">Xem chi tiết <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Không tìm thấy vi phạm nào cho biển số này.</p>
    <?php endif; ?>
</section>