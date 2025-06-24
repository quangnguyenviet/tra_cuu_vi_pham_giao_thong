
<h2 class="form-title"><i class="fas fa-plus-circle"></i> Thêm Vi phạm Mới</h2>
<form id="violationForm" enctype="multipart/form-data" class="violation-form">
    <div class="form-row">
        <div class="form-group">
            <label for="violationPlate"><i class="fas fa-car"></i> Biển số xe:</label>
            <input type="text" id="violationPlate" name="violationPlate" placeholder="Ví dụ: 30A-123.45" required>
        </div>
        <div class="form-group">
            <label for="violationDate"><i class="fas fa-calendar-day"></i> Ngày vi phạm:</label>
            <input type="date" id="violationDate" name="violationDate" required>
        </div>
        <div class="form-group">
            <label for="violationTime"><i class="fas fa-clock"></i> Giờ vi phạm:</label>
            <input type="time" id="violationTime" name="violationTime" required>
        </div>
    </div>
    <div class="form-group">
        <label for="violationLocation"><i class="fas fa-map-marker-alt"></i> Địa điểm:</label>
        <input type="text" id="violationLocation" name="violationLocation" placeholder="Ví dụ: Ngã tư X, Đường Y, Quận Z" required>
    </div>
    <div class="form-group">
        <label for="violationType"><i class="fas fa-exclamation-triangle"></i> Lỗi vi phạm:</label>
        <textarea id="violationType" name="violationType" placeholder="Mô tả chi tiết lỗi vi phạm, ví dụ: Vượt đèn đỏ" required></textarea>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="violationFine"><i class="fas fa-money-bill-wave"></i> Mức phạt chính thức (VND):</label>
            <input type="number" id="violationFine" name="violationFine" placeholder="Ví dụ: 500000" required>
        </div>
        <div class="form-group">
            <label for="expectedFineFrom"><i class="fas fa-arrow-down"></i> Mức phạt dự kiến từ (VND):</label>
            <input type="number" id="expectedFineFrom" name="expectedFineFrom" placeholder="Ví dụ: 400000">
        </div>
        <div class="form-group">
            <label for="expectedFineTo"><i class="fas fa-arrow-up"></i> Mức phạt dự kiến đến (VND):</label>
            <input type="number" id="expectedFineTo" name="expectedFineTo" placeholder="Ví dụ: 600000">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="regulation"><i class="fas fa-gavel"></i> Điều khoản áp dụng:</label>
            <input type="text" id="regulation" name="regulation" placeholder="Ví dụ: Điều 6 Nghị định 100/2019/NĐ-CP">
        </div>
        <div class="form-group">
            <label for="deadline"><i class="fas fa-hourglass-end"></i> Hạn nộp phạt:</label>
            <input type="date" id="deadline" name="deadline">
        </div>
    </div>
    <div class="form-group">
        <label for="regulationDesc"><i class="fas fa-info-circle"></i> Mô tả điều khoản:</label>
        <textarea id="regulationDesc" name="regulationDesc" placeholder="Mô tả chi tiết điều khoản"></textarea>
    </div>
    <div class="form-group">
        <label for="additionalPenalty"><i class="fas fa-user-lock"></i> Hình phạt bổ sung:</label>
        <input type="text" id="additionalPenalty" name="additionalPenalty" placeholder="Ví dụ: Tước GPLX 2 tháng">
    </div>
    <div class="form-group">
        <label for="violationImage"><i class="fas fa-image"></i> Hình ảnh/Video liên quan:</label>
        <input type="file" id="violationImage" name="violationImage" accept="image/*,video/*">
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Thêm Vi phạm Mới</button>
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
.form-group textarea {
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
.form-group textarea:focus {
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

<script>
document.getElementById('violationForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    try {
        const response = await fetch('index.php?url=admin/violations', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        if (result.success) {
            alert('Thêm vi phạm thành công!');
            form.reset();
        } else {
            alert(result.message || 'Có lỗi xảy ra!');
        }
    } catch (err) {
        alert('Lỗi kết nối máy chủ!');
    }
});
</script>