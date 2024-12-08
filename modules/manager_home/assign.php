<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phân Công Lịch - Quản Lý Du Lịch</title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css">
    <script src="/Tour_management/asset/js/jquery-3.7.1.js"></script>
    <script src="/Tour_management/asset/js/boostrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e1f5fe;
            margin: 0;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            height: 100vh;
            background: linear-gradient(90deg, rgba(8,80,120,1) 0%, rgba(133,216,206,1) 100%) !important;
            padding-top: 20px;
            width: 250px;
            position: fixed;
        }
        
        .sidebar a {
            font-size: 1.1rem;
            color: white;
            padding: 15px;
            text-decoration: none;
            display: block;
        }

        .sidebar a:hover {
            background-color: rgba(8,80,120,1);
            text-decoration: none;
        }

        .content {
            margin-left: 250px;
            padding: 40px;
            height: 100vh;
            overflow-y: auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #logo{
            max-height: 10vh;
            width: 100%;
            display: block;
            margin: auto;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #0277bd;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #01579b;
        }

        .btn-secondary {
            background-color: #757575;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
        }

        .btn-secondary:hover {
            background-color: #616161;
        }

        .form-select, .form-control {
            border-radius: 8px;
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .text-end {
            margin-bottom: 20px;
        }

        label.form-label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }
    </style>
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
        <a href="./create_invoice.php">Tạo Hoá Đơn</a>
        <a href="/Tour_management/modules/tour_manager/index.php">Quản Lý Tour</a>
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