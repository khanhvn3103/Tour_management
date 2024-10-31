<?php

// Đăng xuất nếu nhấp vào nút đăng xuất
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: DangNhap.php");
    exit;
}

// Xử lý đăng nhập khi gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra người dùng và mật khẩu
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Xác minh mật khẩu
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: DangNhap.php"); // Tải lại trang cho giao diện dashboard
            exit;
        } else {
            $error = "Sai mật khẩu!";
        }
    } else {
        $error = "Người dùng không tồn tại!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập Tour Du Lịch</title>
</head>
<body>
    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Dashboard khi đã đăng nhập -->
        <h2>Chào mừng đến với Bảng Điều Khiển Tour Du Lịch</h2>
        <a href="DangNhap.php?logout=true">Đăng Xuất</a>
    <?php else: ?>
        <!-- Form Đăng nhập -->
        <h2>Đăng Nhập Tour Du Lịch</h2>
        <form action="DangNhap.php" method="post">
            <label for="username">Tên Đăng Nhập:</label>
            <input type="text" name="username" required><br><br>
            <label for="password">Mật Khẩu:</label>
            <input type="password" name="password" required><br><br>
            <button type="submit">Đăng Nhập</button>
        </form>
        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <?php endif; ?>
</body>
</html>
