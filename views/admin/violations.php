<div id="violations" class="section">
    <h2 class="page-title"><i class="fas fa-list"></i> Danh sách Vi phạm</h2>
    <form method="get" action="index.php" class="search-form">
        <input type="hidden" name="url" value="admin/violations">
        <input type="text" name="search_plate" class="search-input" placeholder="Nhập biển số xe..." value="<?= htmlspecialchars($_GET['search_plate'] ?? '') ?>">
        <select name="search_status" class="search-select">
            <option value="">-- Tất cả trạng thái --</option>
            <option value="Chưa nộp phạt" <?= (($_GET['search_status'] ?? '') === 'Chưa nộp phạt') ? 'selected' : '' ?>>Chưa nộp phạt</option>
            <option value="Đã nộp phạt" <?= (($_GET['search_status'] ?? '') === 'Đã nộp phạt') ? 'selected' : '' ?>>Đã nộp phạt</option>
        </select>
        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tìm kiếm</button>
    </form>
    <div class="table-responsive">
        <table class="styled-table">
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
                            <td>
                                <span class="status <?= $violation['status'] === 'Đã nộp phạt' ? 'paid' : 'unpaid' ?>">
                                    <?= htmlspecialchars($violation['status']) ?>
                                </span>
                            </td>
                            <td>
                                <a href="index.php?url=admin/violations_edit&id=<?= $violation['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</a>
                                <button type="button" class="btn btn-danger btn-sm btn-delete-violation" data-id="<?= $violation['id'] ?>"><i class="fas fa-trash"></i> Xóa</button>
                            </td>
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <?php if ($totalPages > 1): ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="index.php?url=admin/violations&page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Font Awesome CDN nếu chưa có -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
#violations {
    max-width: 1100px;
    margin: 32px auto 0 auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.07);
    padding: 32px 24px 24px 24px;
}
.page-title {
    color: #00509e;
    margin-bottom: 24px;
    text-align: center;
    font-size: 2em;
    font-weight: 600;
}
.search-form {
    display: flex;
    gap: 12px;
    margin-bottom: 24px;
    justify-content: center;
    flex-wrap: wrap;
}
.search-input, .search-select {
    padding: 8px 12px;
    border: 1px solid #b7c6d9;
    border-radius: 5px;
    font-size: 1em;
    background: #f8fafc;
    min-width: 180px;
}
.btn.btn-primary {
    background: #00509e;
    color: #fff;
    border: none;
    padding: 8px 22px;
    border-radius: 5px;
    font-size: 1em;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    gap: 6px;
}
.btn.btn-primary:hover { background: #003f7e; }
.btn.btn-warning { background: #ffc107; color: #222; }
.btn.btn-warning:hover { background: #e0a800; }
.btn.btn-danger { background: #dc3545; color: #fff; }
.btn.btn-danger:hover { background: #b52a37; }
.btn-sm { padding: 6px 12px; font-size: 0.98em; }
.table-responsive { overflow-x: auto; }
.styled-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    margin-bottom: 18px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.styled-table th, .styled-table td {
    padding: 12px 10px;
    border-bottom: 1px solid #e0e6f0;
    text-align: left;
}
.styled-table th {
    background: #f0f4fa;
    color: #00509e;
    font-weight: 600;
}
.styled-table tr:hover {
    background: #f6faff;
}
.status {
    padding: 4px 12px;
    border-radius: 12px;
    font-weight: 500;
    font-size: 0.98em;
}
.status.paid {
    background: #e6f9e6;
    color: #1e7e34;
    border: 1px solid #b2e2b2;
}
.status.unpaid {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeeba;
}
.pagination {
    text-align: center;
    margin: 18px 0 0 0;
}
.pagination a {
    margin: 0 3px;
    padding: 6px 14px;
    border: 1px solid #ccc;
    border-radius: 3px;
    text-decoration: none;
    color: #00509e;
    background: #fff;
    transition: background 0.2s, color 0.2s;
}
.pagination a.active,
.pagination a:hover {
    background: #00509e;
    color: #fff;
    border-color: #00509e;
}
@media (max-width: 900px) {
    #violations { padding: 12px 2px; }
    .search-form { flex-direction: column; gap: 8px; }
    .styled-table th, .styled-table td { padding: 8px 4px; }
}
</style>

<script>
document.querySelectorAll('.btn-delete-violation').forEach(btn => {
    btn.addEventListener('click', function () {
        if (!confirm('Bạn có chắc chắn muốn xóa vi phạm này?')) return;
        const id = this.getAttribute('data-id');
        fetch(`index.php?url=admin/violations_delete&id=${id}`, {
            method: 'GET'
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Đã xóa thành công!');
                    location.reload();
                } else {
                    alert(data.message || 'Xóa thất bại!');
                }
            })
            .catch(() => alert('Lỗi kết nối máy chủ!'));
    });
});
</script>