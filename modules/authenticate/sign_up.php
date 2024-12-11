<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traveloka - Đăng ký Tour</title>
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
        .signup-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 500px;
            padding: 20px;
        }
        .signup-container h1 {
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
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            border-color: #4facfe;
            outline: none;
            box-shadow: 0 0 5px rgba(79, 172, 254, 0.5);
        }
        .signup-button {
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
        .signup-button:hover {
            background: #00f2fe;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h1>Đăng ký Tour du lịch</h1>
        <form action="xuly.php" method="POST">
        <form method="POST" action="process_tour_signup.php">
            <div class="form-group">
                <label for="fullname">Họ và Tên</label>
                <input type="text" id="fullname" name="fullname" placeholder="Nhập họ và tên" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Nhập email của bạn" required>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
            </div>
            <div class="form-group">
                <label for="tour-date">Ngày Tạo Tour</label>
                <input type="date" id="tour-date" name="tour_date" required>
            </div>
            <div class="form-group">
                <label for="tour">Chọn Tour</label>
                <select id="tour" name="tour" required>
                    <option value="">-- Chọn Tour --</option>
                    <option value="danang">Đà Nẵng - Bà Nà</option>
                    <option value="dalat">Đà Lạt - Thành phố Hoa</option>
                    <option value="halong">Hạ Long - Vịnh kỳ quan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="notes">Ghi chú</label>
                <textarea id="notes" name="notes" rows="4" placeholder="Nhập ghi chú nếu có"></textarea>
            </div>
            <button type="submit" class="signup-button">Đăng ký</button>
        </form>
    </div>
</body>
</html>
