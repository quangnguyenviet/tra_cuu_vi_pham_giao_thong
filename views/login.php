<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #00509e 60%, #7abaff 100%);
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 6px 32px rgba(0, 0, 0, 0.12);
            padding: 38px 32px 28px 32px;
            max-width: 370px;
            width: 100%;
        }

        .login-title {
            text-align: center;
            color: #00509e;
            font-size: 2em;
            font-weight: 700;
            margin-bottom: 24px;
            letter-spacing: 1px;
        }

        .login-container label {
            color: #00509e;
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #b7c6d9;
            border-radius: 6px;
            font-size: 1em;
            background: #f8fafc;
            margin-bottom: 18px;
            transition: border 0.2s;
        }

        .login-container input:focus {
            border-color: #00509e;
            outline: none;
        }

        .login-container button {
            width: 100%;
            background: #00509e;
            color: #fff;
            border: none;
            padding: 12px 0;
            border-radius: 6px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .login-container button:hover {
            background: #003f7e;
        }

        .login-container .register-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #00509e;
            text-decoration: none;
            font-size: 1em;
            transition: color 0.2s;
        }

        .login-container .register-link:hover {
            color: #003f7e;
            text-decoration: underline;
        }

        .login-container .error-message {
            color: #dc3545;
            background: #ffeaea;
            border: 1px solid #ffc2c2;
            border-radius: 5px;
            padding: 8px 12px;
            margin-bottom: 16px;
            text-align: center;
        }

        @media (max-width: 500px) {
            .login-container {
                padding: 18px 6px;
            }

            .login-title {
                font-size: 1.3em;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-title"><i class="fas fa-user-shield"></i> Đăng nhập Admin</div>
        <?php if (!empty($error)): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <label for="username"><i class="fas fa-user"></i> Tên đăng nhập:</label>
            <input type="text" id="username" name="username" required autofocus>
            <label for="password"><i class="fas fa-lock"></i> Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit"><i class="fas fa-sign-in-alt"></i> Đăng nhập</button>
        </form>

    </div>

    <script>
        document.querySelector('.login-container form').addEventListener('submit', function (e) {
            e.preventDefault();
            var form = e.target;
            var formData = new FormData(form);

            // Xóa thông báo lỗi cũ nếu có
            var oldError = document.querySelector('.error-message');
            if (oldError) oldError.remove();

            fetch('index.php?url=login', {
                method: 'POST',
                body: formData
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (result) {
                    if (result.success) {
                        window.location.href = result.redirect;
                    } else {
                        var errorDiv = document.createElement('div');
                        errorDiv.className = 'error-message';
                        errorDiv.innerText = result.error || 'Đăng nhập thất bại!';
                        form.parentNode.insertBefore(errorDiv, form);
                    }
                })
                .catch(function () {
                    var errorDiv = document.createElement('div');
                    errorDiv.className = 'error-message';
                    errorDiv.innerText = 'Lỗi kết nối máy chủ!';
                    form.parentNode.insertBefore(errorDiv, form);
                });
        });
    </script>
</body>

</html>