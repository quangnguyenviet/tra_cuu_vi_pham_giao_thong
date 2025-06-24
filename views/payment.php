
<div class="payment-card">
    <h2><i class="fas fa-file-invoice-dollar"></i> Xác nhận và Thanh toán Quyết định
        #<?= htmlspecialchars($violation['id']) ?></h2>

    <section class="info-section">
        <h3><i class="fas fa-receipt"></i> Thông tin vi phạm cần thanh toán</h3>
        <div class="info-item"><strong>Mã quyết định/vi phạm:</strong> <?= htmlspecialchars($violation['id']) ?></div>
        <div class="info-item"><strong>Biển số xe:</strong> <span
                class="license-plate"><?= htmlspecialchars($violation['license_plate']) ?></span></div>
        <div class="info-item"><strong>Loại vi phạm:</strong> <?= htmlspecialchars($violation['violation_type']) ?>
        </div>
        <div class="info-item"><strong>Ngày vi phạm:</strong>
            <?= date('d/m/Y', strtotime($violation['violation_time'])) ?></div>
        <div class="info-item"><strong>Số tiền phạt:</strong> <span
                class="fine-amount"><?= number_format($violation['fine_amount']) ?> VNĐ</span></div>
    </section>

    <section class="payment-methods-section">
        <h3><i class="fas fa-wallet"></i> Quét mã QR</h3>
        <!-- <div class="payment-methods">
            <label class="payment-method selected">
                <i class="fas fa-wallet"></i>
                <span>Ví điện tử<br>(ZaloPay)</span>
            </label>
        </div> -->
        <div id="ewallet-instructions" class="payment-method-details" style="display: block;">
            <p>Quét mã QR bên dưới bằng ứng dụng ZaloPay hoặc các ngân hàng liên kết với zalopay để hoàn tất thanh toán.</p>
            <?php if (!empty($qr_url)): ?>
                <div style="text-align:center; margin-top:10px;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=<?= urlencode($qr_url) ?>"
                        alt="QR ZaloPay" style="border:1px solid #ccc;">
                    <p><a href="<?= htmlspecialchars($qr_url) ?>" target="_blank" class="btn btn-primary"
                            style="margin-top:10px;">Mở ZaloPay để thanh toán</a></p>
                </div>
            <?php else: ?>
                <p style="color:red;">Không tạo được mã QR thanh toán. Vui lòng thử lại sau.</p>
            <?php endif; ?>
        </div>
    </section>

    

    <div class="secure-payment-notice">
        <p><i class="fas fa-shield-alt"></i> Giao dịch được thực hiện qua cổng thanh toán bảo mật.</p>
    </div>
    <div style="text-align:center; margin-top: 18px;">
        <a href="index.php?url=violation_detail&id=<?= $violation['id'] ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại trang chi tiết
        </a>
    </div>
</div>