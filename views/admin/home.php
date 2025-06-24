<div class="dashboard-section">
    <h2 class="dashboard-title"><i class="fas fa-chart-pie"></i> Tổng quan Hệ thống</h2>
    <p class="dashboard-desc">Hiển thị các số liệu thống kê nhanh về tình hình vi phạm, số lượng phương tiện, người
        dùng, v.v.</p>
    <div class="dashboard-cards">
        <div class="dashboard-card">
            <div class="card-icon card-blue"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="card-label">Tổng số vi phạm</div>
            <div class="card-value"><?= $total_violations ?></div>
        </div>
        <div class="dashboard-card">
            <div class="card-icon card-orange"><i class="fas fa-hourglass-half"></i></div>
            <div class="card-label">Vi phạm chưa nộp phạt</div>
            <div class="card-value"><?= $unpaid_violations ?></div>
        </div>
        <div class="dashboard-card">
            <div class="card-icon card-green"><i class="fas fa-check-circle"></i></div>
            <div class="card-label">Vi phạm đã thanh toán</div>
            <div class="card-value"><?= $paid_violations ?></div>
        </div>
        <div class="dashboard-card">
            <div class="card-icon card-purple"><i class="fas fa-car"></i></div>
            <div class="card-label">Phương tiện đăng ký</div>
            <div class="card-value"><?= $total_vehicles ?></div>
        </div>
    </div>
</div>

<!-- Font Awesome CDN nếu chưa có -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    .dashboard-section {
        max-width: 1100px;
        margin: 32px auto 0 auto;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
        padding: 32px 24px 32px 24px;
    }

    .dashboard-title {
        color: #00509e;
        margin-bottom: 12px;
        text-align: center;
        font-size: 2em;
        font-weight: 700;
    }

    .dashboard-desc {
        text-align: center;
        color: #555;
        margin-bottom: 32px;
    }

    .dashboard-cards {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .dashboard-card {
        background: #f8fafc;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        padding: 28px 32px 22px 32px;
        min-width: 210px;
        flex: 1 1 210px;
        max-width: 250px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.15s;
    }

    .dashboard-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 6px 24px rgba(0, 80, 158, 0.13);
    }

    .card-icon {
        font-size: 2.2em;
        margin-bottom: 12px;
        padding: 16px;
        border-radius: 50%;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-blue {
        background: #00509e;
    }

    .card-orange {
        background: #ff9800;
    }

    .card-green {
        background: #28a745;
    }

    .card-purple {
        background: #7c3aed;
    }

    .card-label {
        font-size: 1.08em;
        color: #00509e;
        margin-bottom: 6px;
        font-weight: 500;
        text-align: center;
    }

    .card-value {
        font-size: 2em;
        font-weight: 700;
        color: #222;
        margin-bottom: 0;
    }

    .status-chua-xu-ly {
        color: #ff9800;
    }

    .status-da-thanh-toan {
        color: #28a745;
    }

    @media (max-width: 900px) {
        .dashboard-cards {
            flex-direction: column;
            gap: 18px;
        }

        .dashboard-card {
            max-width: 100%;
        }
    }
</style>