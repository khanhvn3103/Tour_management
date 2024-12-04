<?php
// Xử lý khi form được gửi
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $tour = $_POST['tour'];
    $notes = $_POST['notes'];

    // Kiểm tra các trường bắt buộc
    if (empty($name) || empty($email) || empty($phone) || empty($tour)) {
        $message = "Vui lòng điền đầy đủ thông tin!";
    } else {
        // Giả lập xử lý lưu thông tin vào cơ sở dữ liệu
        // $conn = new mysqli("localhost", "username", "password", "database_name");

        // if ($conn->connect_error) {
        //     die("Kết nối thất bại: " . $conn->connect_error);
        // }

        // Lưu dữ liệu vào bảng `tour_registrations`
        // $sql = "INSERT INTO tour_registrations (name, email, phone, tour, notes)
        //         VALUES ('$name', '$email', '$phone', '$tour', '$notes')";

        // if ($conn->query($sql) === TRUE) {
        //     $message = "Cảm ơn bạn đã đăng ký tour $tour!";
        // } else {
        //     $message = "Lỗi: " . $conn->error;
        // }

        // $conn->close();

        // Thông báo thành công (giả lập)
        $message = "Cảm ơn $name đã đăng ký tour $tour. Chúng tôi sẽ liên hệ với bạn qua số điện thoại $phone!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký Tour du lịch</title>
    <style>
        body {
             font-family: Arial, sans-serif; background-color: #f8f9fa; 
            }
        .container {
             max-width: 500px; margin: 50px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            }
        h2 {
             text-align: center; color: #333; 
            }
        label {
             display: block; margin: 10px 0 5px; 
            }
        input, select, textarea {
             width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; 
            }
        .submit-btn {
             background-color: #28a745; color: #fff; padding: 10px; border: none; border-radius: 4px; cursor: pointer; margin-top: 15px; }
        .submit-btn:hover {
             background-color: #218838; }
        .message {
             color: green; text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đăng ký Tour du lịch</h2>
        
        <?php if (!empty($message)) { echo "<p class='message'>$message</p>"; } ?>
        
        <form action="DangKyTour.php" method="post">
            <label for="name">Họ và Tên</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Số điện thoại</label>
            <input type="text" id="phone" name="phone" required>

            <label for="ngay">Ngày Tạo Tour</label>
            <input type="date" id="ngay" name="ngay" required>

            <label for="tour">Chọn Tour</label>
            <select id="tour" name="tour" required>
                <option value="">-- Chọn Tour --</option>
                <option value="danang">Đà Nẵng - Bà Nà</option>
                <option value="dalat">Đà Lạt - Thành phố Hoa</option>
                <option value="halong">Hạ Long - Vịnh kỳ quan</option>
            </select>

            <label for="notes">Ghi chú</label>
            <textarea id="notes" name="notes" rows="4" placeholder="Nhập ghi chú nếu có"></textarea>

            <button type="submit" class="submit-btn">Đăng ký</button>
        </form>
    </div>
</body>
</html>
