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
            background-image: url(/Tour_management/asset/images/login.jpg);
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.3); /* Chỉ làm mờ nền */
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
    </style>
</head>
<body>
    <div class="login-container">
        <form action="login.php" method="post">
            <h2 class="mb-4">Đăng Nhập</h2>
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

    <?php
    // PHP code to handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        // Here you should handle login logic, e.g., check credentials in database
        // For demo purposes, we will just display the input values
        echo "<div class='login-container mt-3'>";
        echo "<p>Tên đăng nhập: $username</p>";
        echo "<p>Mật khẩu: $password</p>";
        echo "</div>";
    }
    ?>
</body>
</html>
