<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traveloka - Đăng nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            padding: 20px;
        }
        .login-container h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group input:focus {
            border-color: #4facfe;
            outline: none;
            box-shadow: 0 0 5px rgba(79, 172, 254, 0.5);
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            display: none;
        }
        .login-button {
            background: #4facfe;
            color: white;
            font-size: 16px;
            font-weight: bold;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .login-button:hover {
            background: #00f2fe;
        }
        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }
        .forgot-password a {
            text-decoration: none;
            color: #4facfe;
            font-size: 14px;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
        .signup-link {
            text-align: center;
            margin-top: 20px;
        }
        .signup-link a {
            text-decoration: none;
            color: #4facfe;
            font-weight: bold;
        }
    </style>
    <script>
        function validateForm() {
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const errorMessage = document.getElementById('error-message');

            if (!email.value || !password.value) {
                errorMessage.textContent = 'Vui lòng điền đầy đủ email và mật khẩu!';
                errorMessage.style.display = 'block';
                return false;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email.value)) {
                errorMessage.textContent = 'Email không hợp lệ!';
                errorMessage.style.display = 'block';
                return false;
            }

            errorMessage.style.display = 'none';
            return true;
        }
    </script>
</head>
<body>
    <div class="login-container">
        <h1>Đăng nhập Traveloka</h1>
        <form action="xuly.php" method="POST"></form>
        <form method="POST" action="process_login.php" onsubmit="return validateForm()">
            <div id="error-message" class="error-message"></div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Nhập email của bạn" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu của bạn" required>
            </div>
            <button type="submit" class="login-button">Đăng nhập</button>
        </form>
        <div class="forgot-password">
            <a href="#">Quên mật khẩu?</a>
        </div>
        <div class="signup-link">
            Chưa có tài khoản? <a href="#">Đăng ký ngay</a>
        </div>
    </div>
</body>
</html>