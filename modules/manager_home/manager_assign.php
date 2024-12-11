<?php
include_once("../../models/mUsers.php");
include_once("../../models/mTour.php");
include_once("../../models/mWorkSchedules.php");

// Khởi tạo các đối tượng model
$userModel = new modelUser();
$tourModel = new modelTour();
$workSchedulesModel = new modelWorkSchedules();

// Lấy danh sách tất cả các tour
$tours = $tourModel->getAllTours();

$tourCode = '';
$guides = [];
$drivers = [];
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tourCode'])) {
        $tourCode = $_POST['tourCode'];
        $availableEmployees = $workSchedulesModel->getAvailableEmployees($tourCode);

        $guides = array_filter($availableEmployees, fn($e) => $e['role'] === 'Hướng dẫn viên');
        $drivers = array_filter($availableEmployees, fn($e) => $e['role'] === 'Tài xế');
    }

    if (isset($_POST['assign'])) {
        $guideCode = $_POST['guideCode'];
        $driverCode = $_POST['driverCode'];

        if ($guideCode && $driverCode && $tourCode) {
            $resultGuide = $workSchedulesModel->assignEmployeeToTour($guideCode, $tourCode);
            $resultDriver = $workSchedulesModel->assignEmployeeToTour($driverCode, $tourCode);

            if ($resultGuide && $resultDriver) {
                $message = 'Phân công thành công!';
                $guides = [];
                $drivers = [];
                $tourCode = '';
            } else {
                $message = 'Phân công thất bại!';
            }
        } else {
            $message = 'Vui lòng chọn đầy đủ thông tin để phân công!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Phân Công Lịch</title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Tour_management/asset/css/manager_home.css">
    <script src="/Tour_management/asset/js/bootstrap.bundle.min.js"></script>
    <script src="/Tour_management/asset/js/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#assignButton').click(function(event) {
                const tour = $('#tourSelect').val();
                const guide = $('#guideSelect').val();
                const driver = $('#driverSelect').val();

                if (tour === "" || guide === "" || driver === "") {
                    alert('Vui lòng chọn đầy đủ thông tin!');
                    event.preventDefault();
                }
            });

            // Khi người dùng chọn tour, gửi yêu cầu để cập nhật danh sách nhân viên khả dụng
            $('#tourSelect').change(function() {
                $('#assignForm').submit();
            });
        });
    </script>
</head>
<body>
    <div class="sidebar">
        <a href="/Tour_management/index.php" style="max-width: 100%;">
            <img id="logo" src="/Tour_management/asset/images/travellowkey_logo.png" alt="Logo">
        </a>
        <a href="/Tour_management/modules/manager_home/manager_home.php">Thống Kê</a>
        <a href="/Tour_management/modules/manager_home/manager_employee.php">Danh Sách Tài Khoản</a>
        <a href="/Tour_management/modules/manager_home/manager_voucher.php">Thêm Voucher</a>
        <a href="/Tour_management/modules/manager_home/manager_assign.php">Phân Công Lịch</a>
        <a href="/Tour_management/modules/manager_home/manager_bill.php">Tạo Hoá Đơn</a>
        <a href="/Tour_management/modules/tour_manage/index.php">Quản Lý Tour</a>
        <a href="/Tour_management/modules/tour_category_management/index.php">Quản Lý Gói Tour</a>
        <a href="./sightseeing_list.php">Danh Sách Điểm Tham Quan</a>
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
        <?php if ($message) { ?>
            <div class="alert alert-info" role="alert">
                <?= $message ?>
            </div>
        <?php } ?>
        <form id="assignForm" method="POST" action="">
            <div class="mb-4">
                <label for="tourSelect" class="form-label">Chọn Tour</label>
                <select id="tourSelect" name="tourCode" class="form-select">
                    <option value="" <?= ($tourCode === '') ? 'selected' : '' ?>>Chọn Tour...</option>
                    <?php foreach ($tours as $tour) { ?>
                        <option value="<?= $tour['tourCode'] ?>" <?= ($tourCode === $tour['tourCode']) ? 'selected' : '' ?>><?= $tour['tourName'] ?> - <?= number_format($tour['price'], 0, ',', '.') ?> VND</option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="guideSelect" class="form-label">Chọn Hướng Dẫn Viên</label>
                <select id="guideSelect" name="guideCode" class="form-select">
                    <option value="" selected>Chọn Hướng dẫn viên...</option>
                    <?php foreach ($guides as $guide) { ?>
                        <option value="<?= $guide['employeeCode'] ?>"><?= $guide['fullName'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="driverSelect" class="form-label">Chọn Tài Xế</label>
                <select id="driverSelect" name="driverCode" class="form-select">
                    <option value="" selected>Chọn Tài xế...</option>
                    <?php foreach ($drivers as $driver) { ?>
                        <option value="<?= $driver['employeeCode'] ?>"><?= $driver['fullName'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="text-end">
                <button type="submit" name="assign" id="assignButton" class="btn btn-primary">Xác Nhận Phân Công</button>
            </div>
        </form>
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