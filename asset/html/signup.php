<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Tài Khoản Nhân Viên</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: linear-gradient(to bottom right, #c6ffdd, #fbd786, #f7797d);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            width: 1000px;
            display: flex;
            flex-wrap: wrap;
            border: none;
            animation: fadeIn 1s ease-in-out;
            overflow: hidden;
            position: relative;
            transition: transform 0.3s ease-in-out;
        }

        .container:hover {
            transform: scale(1.02);
        }

        .form-column {
            flex: 1;
            min-width: 450px;
            padding: 20px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-column h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1b5e20;
            font-weight: 700;
            text-transform: uppercase;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
            box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #f9fbe7;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: #1b5e20;
            box-shadow: 0 0 12px rgba(27, 94, 32, 0.5);
            outline: none;
            background-color: #e8f5e9;
        }

        .form-group .radio-group {
            display: flex;
            justify-content: space-between;
        }

        .form-group .radio-group label {
            font-weight: normal;
            display: flex;
            align-items: center;
        }

        .form-group .radio-group input[type="radio"] {
            margin-right: 8px;
        }

        .submit-btn {
            width: 100%;
            padding: 18px;
            background-color: #1b5e20;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .submit-btn:hover {
            background-color: #388e3c;
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        .submit-btn:active {
            transform: translateY(2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-footer {
            margin-top: 20px;
            text-align: center;
        }

        .form-footer a {
            color: #1b5e20;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .form-footer a:hover {
            color: #388e3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-column">
            <h2>Thông Tin Tài Khoản</h2>
            <form action="/employee_register.php" method="POST">
                <div class="form-group">
                    <label for="fullName">Họ và Tên</label>
                    <input type="text" id="fullName" name="fullName" required>
                </div>
                <div class="form-group">
                    <label for="username">Tên Đăng Nhập</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật Khẩu</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="submit-btn">Đăng Ký</button>
            </form>
          
        </div>
        <div class="form-column">
            <h2>Thông Tin Liên Hệ</h2>
            <form>
                <div class="form-group">
                    <label for="identifyCard">Số CMND/CCCD</label>
                    <input type="text" id="identifyCard" name="identifyCard" required>
                </div>
                <div class="form-group">
                    <label for="address">Địa Chỉ</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="phone">Số Điện Thoại</label>
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>
                </div>
                <div class="form-group">
                    <label>Giới Tính</label>
                    <div class="radio-group">
                        <label><input type="radio" name="gender" value="male" required> Nam</label>
                        <label><input type="radio" name="gender" value="female" required> Nữ</label>
                        <label><input type="radio" name="gender" value="other" checked required> Khác</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.querySelector('.password-toggle').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
    </script>
</body>
</html>