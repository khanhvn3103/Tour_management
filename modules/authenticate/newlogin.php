<?php
session_start();
include_once("../../models/clsKetNoi.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $conn = new clsKetNoi();
    $db = $conn->ketNoiDB();

    if ($db) {
        // Kiểm tra thông tin đăng nhập trong bảng users
        $query = "SELECT u.username, role, employeeCode, phone, fullName, address, dob, gender, identifyCard
          FROM users u 
          LEFT JOIN employee e ON u.username = e.username 
          WHERE u.username = ? AND u.password = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user'] = $user;

            // Kiểm tra xem người dùng là admin
            $query_employee = "SELECT * FROM employee WHERE username = ?";
            $stmt_employee = $db->prepare($query_employee);
            $stmt_employee->bind_param("s", $username);
            $stmt_employee->execute();
            $result_employee = $stmt_employee->get_result();

            if ($result_employee->num_rows > 0) {
                $employee = $result_employee->fetch_assoc();
                if ($employee['role'] === 'admin') {
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = 'admin';
                    header("Location: http://localhost/Tour_management/modules/manager_home/manager_home.php");
                    exit();
                } else {
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = 'employee';
                    header("Location: http://localhost/Tour_management/index.php");
                    exit();
                }
            } else {
                $query_customer = "SELECT * FROM customer WHERE username = ?";
                $stmt_customer = $db->prepare($query_customer);
                $stmt_customer->bind_param("s", $username);
                $stmt_customer->execute();
                $result_customer = $stmt_customer->get_result();

                if ($result_customer->num_rows > 0) {
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = 'customer';
                    $_SESSION['customerCode'] = $result_customer['customerCode'];
                    header("Location: http://localhost/Tour_management/index.php");
                    exit();
                }
            }
        } else {
            $error_message = "Invalid username or password.";
        }

        $stmt->close();
        $db->close();
    } else {
        $error_message = "Database connection failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css">
    <script src="/Tour_management/asset/js/bootstrap.bundle.min.js"></script>
    <script src="/Tour_management/asset/js/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <style>
        body {
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),
                /* Lớp phủ tối màu */
                url(/Tour_management/asset/images/login.jpg);
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        .login-container .form-group {
            margin-bottom: 1.5rem;
        }

        .login-container .form-control {
            padding: 1rem;
            border-radius: 0.5rem;
        }

        .login-container .btn-primary {
            background-color: #001F3F;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            width: 100%;
        }

        .login-container .btn-primary:hover {
            background-color: #001833;
        }

        .login-container .forgot-password {
            margin-top: 1rem;
            display: block;
            text-align: right;
        }

        .logo {
            width: 250px;
            position: absolute;
            top: 15px;
            left: 15px;
        }
    </style>
</head>

<body>
    <div class="logo">
        <a class="navbar-brand" href="/Tour_management/index.php"> <img src="../../asset/images/travellowkey_logo.png" class="logo"></a>
    </div>
    <div class="login-container">
        <form action="newlogin.php" method="post">
            <h2 class="mb-4">Đăng Nhập</h2>
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger">
                    <?= $error_message ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
            <a href="#" class="forgot-password">Quên mật khẩu?</a>
        </form>
    </div>
</body>

</html>