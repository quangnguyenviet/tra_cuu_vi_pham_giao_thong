<div class="violation-detail-card">
    <h2><i class="fas fa-exclamation-triangle"></i> Thông tin vi phạm chi tiết</h2>

    <section class="detail-section">
        <h3><i class="fas fa-id-card"></i> Thông tin chung</h3>
        <p><strong>Biển số xe:</strong> <span
                class="license-plate"><?= htmlspecialchars($violation['license_plate']) ?></span></p>
        <p><strong>Loại phương tiện:</strong> <?= htmlspecialchars($violation['vehicle_type'] ?? 'Không rõ') ?></p>
       
        <p><strong>Loại vi phạm:</strong> <?= htmlspecialchars($violation['violation_type']) ?></p>
        <p><strong>Thời gian vi phạm:</strong> <?= date('H:i:s - d/m/Y', strtotime($violation['violation_time'])) ?></p>
        <p><strong>Trạng thái xử lý:</strong>
            <span
                class="status-tag <?= $violation['status'] == 'Chưa xử lý' ? 'new' : ($violation['status'] == 'Đã xử lý' ? 'resolved' : 'pending') ?>">
                <?= htmlspecialchars($violation['status']) ?>
            </span>
        </p>
    </section>

    <section class="detail-section">
        <h3><i class="fas fa-map-marker-alt"></i> Địa điểm vi phạm</h3>
        <p><strong>Địa chỉ cụ thể:</strong> <?= htmlspecialchars($violation['location']) ?></p>
    </section>

    <section class="detail-section">
        <h3><i class="fas fa-balance-scale"></i> Quy định & Mức phạt</h3>
        <p><strong>Điều khoản áp dụng:</strong> <?= htmlspecialchars($violation['regulation']) ?></p>
        <p><strong>Mô tả điều khoản:</strong> <?= nl2br(htmlspecialchars($violation['regulation_desc'])) ?></p>
        <p><strong>Mức phạt dự kiến:</strong>
            <?php if ($violation['expected_fine_from'] && $violation['expected_fine_to']): ?>
                <?= number_format($violation['expected_fine_from']) ?> -
                <?= number_format($violation['expected_fine_to']) ?> VNĐ
            <?php else: ?>
                Không xác định
            <?php endif; ?>
        </p>
        <p><strong>Mức phạt chính thức:</strong> <?= number_format($violation['fine_amount']) ?> VNĐ</p>
        <p><strong>Hình phạt bổ sung:</strong> <?= htmlspecialchars($violation['additional_penalty']) ?></p>
        <p><strong>Hạn nộp phạt:</strong>
            <?= $violation['deadline'] ? date('d/m/Y', strtotime($violation['deadline'])) : 'Không có' ?></p>
    </section>

    <?php if (!empty($violation['image_url'])): ?>
        <section class="detail-section">
            <h3><i class="fas fa-image"></i> Hình ảnh/Video bằng chứng</h3>
            <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $violation['image_url'])): ?>
                <img src="<?= htmlspecialchars($violation['image_url']) ?>" alt="Bằng chứng vi phạm"
                    style="max-width: 350px; border-radius: 8px;">
            <?php elseif (preg_match('/\.(mp4|webm|ogg)$/i', $violation['image_url'])): ?>
                <video controls style="max-width: 350px; border-radius: 8px;">
                    <source src="<?= htmlspecialchars($violation['image_url']) ?>">
                    Trình duyệt không hỗ trợ video.
                </video>
            <?php else: ?>
                <a href="<?= htmlspecialchars($violation['image_url']) ?>" target="_blank">Xem bằng chứng</a>
            <?php endif; ?>
        </section>



        <section class="detail-section">
            <h3><i class="fas fa-tasks"></i> Hướng dẫn xử lý</h3>
            <p>Để xử lý vi phạm này, bạn có thể thực hiện một trong các cách sau:</p>
            <ul>
                <li><strong>Nộp phạt trực tuyến:</strong> Truy cập Cổng Dịch Vụ Công Quốc Gia (dichvucong.gov.vn) và làm
                    theo hướng dẫn.</li>
                <li><strong>Nộp phạt trực tiếp:</strong> Đến trụ sở Phòng CSGT Công an Tỉnh/Thành phố nơi xảy ra vi phạm.
                    Địa chỉ: [Địa chỉ phòng CSGT]</li>
                <li><strong>Khiếu nại (nếu có):</strong> Nếu bạn cho rằng có sai sót, vui lòng chuẩn bị các giấy tờ liên
                    quan và liên hệ với cơ quan chức năng theo thông tin bên dưới trong vòng 15 ngày kể từ ngày nhận thông
                    báo.</li>
            </ul>
            <p><strong>Lưu ý:</strong> Việc không nộp phạt đúng hạn có thể dẫn đến các biện pháp cưỡng chế theo quy định của
                pháp luật.</p>
        </section>

        <section class="detail-section">
            <h3><i class="fas fa-headset"></i> Thông tin liên hệ hỗ trợ</h3>
            <p>Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ:</p>
            <p><strong>Phòng CSGT [Tên Tỉnh/Thành Phố]</strong></p>
            <p><strong>Điện thoại:</strong> (02x) xxxx xxxx</p>
            <p><strong>Email:</strong> csgt@[tinhthanh].gov.vn</p>
        </section>

        <div class="actions-section">
    <a href="index.php?url=home" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại trang chủ</a>

    <?php if ($violation['status'] === 'Đã nộp phạt'): ?>
        <button class="btn btn-success" disabled>
            <i class="fas fa-check-circle"></i> Đã nộp phạt
        </button>
    <?php else: ?>
        <a href="index.php?url=payment&violation_id=<?= $violation['id'] ?>" class="btn btn-warning">
            <i class="fas fa-credit-card"></i> Nộp phạt trực tuyến
        </a>
    <?php endif; ?>
</div>
    <?php endif; ?>
</div>