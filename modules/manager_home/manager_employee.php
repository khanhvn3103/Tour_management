<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("../../models/mUsers.php");
$userModel = new modelUser();

// Xử lý yêu cầu thêm, sửa, xóa hoặc lấy thông tin nhân viên
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullName = $_POST['fullName'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $identifyCard = $_POST['identifyCard'];
        $role = $_POST['role'];

        if ($userModel->insertEmployee($username, $password, $fullName, $address, $phone, $dob, $gender, $identifyCard, $role)) {
            echo "Thêm nhân viên thành công.";
        } else {
            echo "Có lỗi xảy ra. Vui lòng thử lại.";
        }
        exit;
    } elseif ($action == 'edit') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullName = $_POST['fullName'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $identifyCard = $_POST['identifyCard'];
        $role = $_POST['role'];

        // Kiểm tra xem người dùng có nhập mật khẩu mới không
        if (empty($password)) {
            // Nếu không nhập mật khẩu mới, giữ nguyên mật khẩu hiện tại
            $employee = $userModel->selectOneUser($username);
            $password = $employee['password'];
        }

        if ($userModel->updateEmployee($username, $password, $fullName, $address, $phone, $dob, $gender, $identifyCard, $role)) {
            echo "Cập nhật thông tin nhân viên thành công.";
        } else {
            echo "Có lỗi xảy ra. Vui lòng thử lại.";
        }
        exit;
    } elseif ($action == 'delete') {
        $username = $_POST['username'];

        if ($userModel->deleteUser($username)) {
            echo "Xóa nhân viên thành công.";
        } else {
            echo "Có lỗi xảy ra. Vui lòng thử lại.";
        }
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'get' && isset($_GET['username'])) {
    $username = $_GET['username'];
    $employee = $userModel->selectOneUser($username);

    // Đảm bảo rằng chỉ trả về JSON hợp lệ
    header('Content-Type: application/json');
    echo json_encode($employee);
    exit;
}

// Xử lý đăng xuất
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    session_start();
    session_unset();
    session_destroy();

    header("Location: /Tour_management/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tài Khoản Nhân Viên</title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Tour_management/asset/css/manager_home.css">
    <script src="/Tour_management/asset/js/bootstrap.bundle.min.js"></script>
    <script src="/Tour_management/asset/js/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
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
        <h2 class="text-primary fw-bold mb-4">Danh Sách Nhân Viên</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Thêm Nhân Viên</button>
        <div class="row mb-4">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Mã Nhân Viên</th>
                            <th scope="col">Tên Đầy Đủ</th>
                            <th scope="col">Tên Tài Khoản</th>
                            <th scope="col">Vai Trò</th>
                            <th scope="col">Địa Chỉ</th>
                            <th scope="col">Số Điện Thoại</th>
                            <th scope="col">Ngày Sinh</th>
                            <th scope="col">Giới Tính</th>
                            <th scope="col">CMND/CCCD</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);
                        include_once("../../models/mUsers.php");
                        $userModel = new modelUser();

                        $employees = $userModel->getAllEmployees();

                        foreach ($employees as $employee) {
                            echo '<tr>';
                            echo '<td>' . $employee['employeeCode'] . '</td>';
                            echo '<td>' . $employee['fullName'] . '</td>';
                            echo '<td>' . $employee['username'] . '</td>';
                            echo '<td>' . $employee['role'] . '</td>';
                            echo '<td>' . $employee['address'] . '</td>';
                            echo '<td>' . $employee['phone'] . '</td>';
                            echo '<td>' . $employee['dob'] . '</td>';
                            echo '<td>' . ($employee['gender'] == 1 ? 'Nam' : 'Nữ') . '</td>';
                            echo '<td>' . $employee['identifyCard'] . '</td>';
                            echo '<td>
                                    <button class="btn btn-warning btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#editEmployeeModal" data-username="' . $employee['username'] . '">Sửa</button>
                                    <button class="btn btn-danger btn-sm delete-button" data-username="' . $employee['username'] . '">Xóa</button>
                                  </td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Thêm Nhân Viên -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Thêm Nhân Viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm">
                        <div class="form-group mb-3">
                            <label for="addUsername">Tên Tài Khoản</label>
                            <input type="text" class="form-control" name="username" id="addUsername" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="addPassword">Mật Khẩu</label>
                            <input type="password" class="form-control" name="password" id="addPassword" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="addFullName">Tên Đầy Đủ</label>
                            <input type="text" class="form-control" name="fullName" id="addFullName" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="addAddress">Địa Chỉ</label>
                            <input type="text" class="form-control" name="address" id="addAddress" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="addPhone">Số Điện Thoại</label>
                            <input type="text" class="form-control" name="phone" id="addPhone" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="addDob">Ngày Sinh</label>
                            <input type="date" class="form-control" name="dob" id="addDob" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="addGender">Giới Tính</label>
                            <select class="form-control" name="gender" id="addGender" required>
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="addIdentifyCard">CMND/CCCD</label>
                            <input type="text" class="form-control" name="identifyCard" id="addIdentifyCard" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="addRole">Vai Trò</label>
                            <input type="text" class="form-control" name="role" id="addRole" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm Nhân Viên</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sửa Nhân Viên -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Chỉnh Sửa Nhân Viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm">
                        <input type="hidden" name="username" id="editUsername">
                        <div class="form-group mb-3">
                            <label for="editPassword">Mật Khẩu</label>
                            <input type="password" class="form-control" name="password" id="editPassword">
                        </div>
                        <div class="form-group mb-3">
                            <label for="editFullName">Tên Đầy Đủ</label>
                            <input type="text" class="form-control" name="fullName" id="editFullName" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="editAddress">Địa Chỉ</label>
                            <input type="text" class="form-control" name="address" id="editAddress" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="editPhone">Số Điện Thoại</label>
                            <input type="text" class="form-control" name="phone" id="editPhone" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="editDob">Ngày Sinh</label>
                            <input type="date" class="form-control" name="dob" id="editDob" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="editGender">Giới Tính</label>
                            <select class="form-control" name="gender" id="editGender" required>
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="editIdentifyCard">CMND/CCCD</label>
                            <input type="text" class="form-control" name="identifyCard" id="editIdentifyCard" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="editRole">Vai Trò</label>
                            <input type="text" class="form-control" name="role" id="editRole" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Xử lý sự kiện khi nhấn nút Xóa
            $('.delete-button').click(function() {
                const username = $(this).data('username');

                if (confirm("Bạn có chắc muốn xóa tài khoản này?")) {
                    $.ajax({
                        url: location.href,
                        method: 'POST',
                        data: {
                            action: 'delete',
                            username: username
                        },
                        success: function(response) {
                            alert("Tài khoản đã được xóa.");
                            location.reload();
                        },
                        error: function() {
                            alert("Có lỗi xảy ra. Vui lòng thử lại.");
                        }
                    });
                }
            });

            // Xử lý sự kiện khi nhấn nút Sửa
            $('.edit-button').click(function() {
                const username = $(this).data('username');

                // Lấy thông tin nhân viên và điền vào modal chỉnh sửa
                $.ajax({
                    url: location.href, // Sử dụng URL hiện tại của trang
                    method: 'GET',
                    data: {
                        action: 'get',
                        username: username
                    },
                    success: function(response) {
                        console.log(response); // Kiểm tra phản hồi từ server

                        // Nếu phản hồi từ server đã là đối tượng JavaScript, sử dụng trực tiếp
                        const employee = (typeof response === 'object') ? response : JSON.parse(response);

                        $('#editUsername').val(employee.username);
                        // $('#editPassword').val(employee.password);
                        $('#editFullName').val(employee.fullName);
                        $('#editAddress').val(employee.address);
                        $('#editPhone').val(employee.phone);
                        $('#editDob').val(employee.dob);
                        $('#editGender').val(employee.gender);
                        $('#editIdentifyCard').val(employee.identifyCard);
                        $('#editRole').val(employee.role);

                        // Hiển thị modal chỉnh sửa
                        $('#editEmployeeModal').modal('show');
                    },
                    error: function() {
                        alert("Không thể lấy dữ liệu nhân viên. Vui lòng thử lại.");
                    }
                });
            });

            // Xử lý sự kiện khi gửi form chỉnh sửa nhân viên
            $('#editEmployeeForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: location.href,
                    method: 'POST',
                    data: $(this).serialize() + '&action=edit',
                    success: function(response) {
                        alert("Thông tin nhân viên đã được cập nhật.");
                        location.reload();
                    },
                    error: function() {
                        alert("Có lỗi xảy ra. Vui lòng thử lại.");
                    }
                });
            });

            // Xử lý sự kiện khi gửi form thêm nhân viên
            $('#addEmployeeForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: location.href,
                    method: 'POST',
                    data: $(this).serialize() + '&action=add',
                    success: function(response) {
                        alert("Nhân viên đã được thêm thành công.");
                        location.reload();
                    },
                    error: function() {
                        alert("Có lỗi xảy ra. Vui lòng thử lại.");
                    }
                });
            });
        });
    </script>

</body>

</html>