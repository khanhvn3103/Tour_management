<?php
include '../../models/tourmanager.php';

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Quản Lý Du Lịch</title>
    <link rel="stylesheet" href="/Tour_management/asset/css/dataTables.bootstrap5.css" id="theme-styles">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/Tour_management/asset/css/manager_home.css">
</head>
<body>
<div class="sidebar">
    <a href="/Tour_management/index.php" style="max-width: 100%;">
        <img id="logo" src="/Tour_management/asset/images/travellowkey_logo.png" alt="Logo">
    </a>
    <a href="/Tour_management/modules/manager_home/manager_home.php">Thống Kê</a>
    <a href="#">Danh Sách Tài Khoản</a>
    <a href="/Tour_management/modules/manager_home/add_employee.php">Thêm Tài Khoản</a>
    <a href="/Tour_management/modules/manager_home/assign.php">Phân Công Lịch</a>
    <a href="#">Tạo Hoá Đơn</a>
    <a href="/Tour_management/modules/tour_manager/index.php">Quản Lý Tour</a>
    <a href="/Tour_management/modules/tour_category_management/index.php">Quản Lý Gói Tour</a>
    <a href="#">Danh Sách Điểm Tham Quan</a>
</div>
<div class="content">
    <div class="col mb-4">
        <div class="text-end">
            <form action="/Tour_management/index.php" method="POST">
                <button type="submit" name="logout" class="btn btn-secondary">Đăng xuất</button>
            </form>
        </div>
    </div>

    <?php

    if(isset($_GET['a'])) {
        $a = $_GET['a'];
        switch ($a) {
            case 'list':
                include 'list.php';
                break;
            case 'create':
                include 'create.php';
                break;
            default:
                include 'list.php';
        }
    } else {
        include 'list.php';
    }
    ?>
</div>

</body>
<script src="/Tour_management/asset/js/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="/Tour_management/asset/js/bootstrap.bundle.min.js"></script>
<script src="/Tour_management/asset/js/dataTables.js"></script>
<script src="/Tour_management/asset/js/dataTables.bootstrap5.js"></script>
<script type="text/javascript" src="/Tour_management/asset/js/manager_home.js"></script>
</html>

