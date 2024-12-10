<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phân Công Lịch - Quản Lý Du Lịch</title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Tour_management/asset/css/assign.css">
    <script src="/Tour_management/asset/js/jquery-3.7.1.js"></script>
    <script src="/Tour_management/asset/js/boostrap.bundle.min.js"></script>
</head>

<body>
    <div class="sidebar">
        <a href="/Tour_management/index.php" style="max-width: 100%;">
            <img id="logo" src="/Tour_management/asset/images/travellowkey_logo.png" alt="Logo">
        </a>
        <a href="/Tour_management/modules/manager_home/manager_home.php">Thống Kê</a>
        <a href="/Tour_management/modules/manager_home/manager_employee.php">Danh Sách Tài Khoản</a>
        <a href="/Tour_management/modules/manager_home/manager_voucher.php">Thêm Voucher</a>
        <a href="/Tour_management/modules/manager_home/assign.php">Phân Công Lịch</a>
        <a href="/Tour_management/modules/manager_home/manager_bill.php">Tạo Hoá Đơn</a>
        <a href="#">Quản Lý Tour</a>
        <a href="#">Danh Sách Điểm Tham Quan</a>
    </div>
    <div class="content">
        <div class="col">
            <div class="text-end">
                <form action="/Tour_management/index.php" method="POST">
                    <button type="submit" name="logout" class="btn btn-secondary">Đăng xuất</button>
                </form>
            </div>
        </div>
        <h2 class="text-primary fw-bold mb-4">Phân Công Lịch Làm Việc</h2>
        <div class="mb-4">
            <label for="billSelect" class="form-label">Chọn Hoá Đơn</label>
            <select id="billSelect" class="form-select">
                <option selected>Chọn hoá đơn...</option>
                <option value="1">Hoá đơn 1 - TP. Hồ Chí Minh - 15,000,000 VND</option>
                <option value="2">Hoá đơn 2 - Hà Nội - 9,000,000 VND</option>
                <option value="3">Hoá đơn 3 - Đà Nẵng - 7,000,000 VND</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="employeeSelect" class="form-label">Chọn Nhân Viên</label>
            <select id="employeeSelect" class="form-select">
                <option selected>Chọn nhân viên...</option>
                <option value="1">Nguyễn Văn A</option>
                <option value="2">Trần Thị B</option>
                <option value="3">Lê Văn C</option>
            </select>
        </div>
        <div class="text-end">
            <button class="btn btn-primary" id="assignButton">Xác Nhận Phân Công</button>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#assignButton').click(function() {
                const bill = $('#billSelect').val();
                const employee = $('#employeeSelect').val();

                if (bill && employee) {
                    alert(`Đã phân công nhân viên ${$('#employeeSelect option:selected').text()} cho hoá đơn ${$('#billSelect option:selected').text()}`);
                } else {
                    alert('Vui lòng chọn đầy đủ thông tin!');
                }
            });
        });
    </script>

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