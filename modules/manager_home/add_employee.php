<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Tài Khoản Nhân Viên</title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/Tour_management/asset/css/docs.css"/>
    <link rel="stylesheet" href="/Tour_management/asset/css/all.css" id="theme-styles"/>
    <link rel="stylesheet" href="/Tour_management/asset/css/boostrap_custome.css" id="theme-styles"/>
    <link rel="stylesheet" href="/Tour_management/asset/css/style.css" id="theme-styles"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/Tour_management/asset/css/add_employee.css">
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-light bg-light p-2 w-100" id="header">
        <div class="container-lg">
        <div class="d-flex align-content-center">
            <a class="navbar-brand" href="/"> <img src="/Tour_management/asset/images/travellowkey_logo.png" class="logo"></a>
            <ul class="navbar-nav">
                <li class="nav-item dropdown pt-lg-3 pb-lg-2 me-lg-n1 me-xl-0 ">
                    <a class="nav-link "  href="/Tour_management/index.php">TRANG CHỦ</a>
                </li>
                <li class="nav-item dropdown pt-lg-3 pb-lg-2 me-lg-n1 me-xl-0">
                    <a class="nav-link" href="./manager_home.php">TRANG QUẢN LÝ CHUNG</a>
                </li>
            </ul>
        </div>
        </div>
    </header>
    <div class="container">
        <div class="col-md-6 mb-4 p-2">
            <h2 class="text-center text-primary fw-bold">Thông Tin Tài Khoản</h2>
            <form action="/employee_register.php" method="POST">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Họ và Tên</label>
                    <input type="text" id="fullName" name="fullName" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Tên Đăng Nhập</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật Khẩu</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn submit-btn">Tạo tài khoản</button>
            </form>
        </div>
        <div class="col-md-6 p-2">
            <h2 class="text-center text-primary fw-bold">Thông Tin Liên Hệ</h2>
            <form>
                <div class="mb-3">
                    <label for="identifyCard" class="form-label">Số CMND/CCCD</label>
                    <input type="text" id="identifyCard" name="identifyCard" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Địa Chỉ</label>
                    <input type="text" id="address" name="address" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số Điện Thoại</label>
                    <input type="tel" id="phone" name="phone" class="form-control" pattern="[0-9]{10}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Giới Tính</label>
                    <div class="d-flex justify-content-between">
                        <div class="form-check">
                            <input type="radio" name="gender" value="male" class="form-check-input" required>
                            <label class="form-check-label">Nam</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" value="female" class="form-check-input" required>
                            <label class="form-check-label">Nữ</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" value="other" class="form-check-input" checked required>
                            <label class="form-check-label">Khác</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>