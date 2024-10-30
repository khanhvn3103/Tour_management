<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Quản Lý Du Lịch</title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/Tour_management/asset/css/manager_home.css">
</head>
<body>
    <div class="sidebar">
        <a href="/Tour_management/index.php" style="max-width: 100%;">
            <img id="logo" src="/Tour_management/asset/images/travellowkey_logo.png" alt="Logo">
        </a>
        <a href="#">Thống Kê</a>
        <a href="./add_employee.php">Thêm Tài Khoản</a>
        <a href="#">Phân Công Lịch</a>
        <a href="#">Tạo Hoá Đơn</a>
        <a href="#">Quản Lý Tour</a>
        <a href="#">Danh Sách Điểm Tham Quan</a>
    </div>
    <div class="content">
        <div class="col">
            <div class="text-end">
                <button type="submit" name="logout" class="btn btn-secondary">Đăng xuất</button>
            </div>
        </div>
        <h2 class="text-primary fw-bold mb-4">Tổng Quan Thống Kê</h2>
        <div class="row">
            <div class="card card-container">
                <div class="card-body">
                    <h5 class="card-title">Hoá Đơn Đã Tạo</h5>
                    <p class="card-text">Chi tiết về số lượng hoá đơn đã được tạo trong thời gian đã chọn.</p>
                </div>
            </div>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
        session_start();
        session_unset();
        session_destroy();

        header("Location: /Tour_management/index.php");
        exit();
    }
    ?>
</body>
</html>
