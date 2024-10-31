<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Quản Lý Du Lịch</title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/Tour_management/asset/css/manager_home.css">
    <script src="/Tour_management/asset/js/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="/Tour_management/asset/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="sidebar">
    <a href="/Tour_management/index.php" style="max-width: 100%;">
        <img id="logo" src="/Tour_management/asset/images/travellowkey_logo.png" alt="Logo">
    </a>
    <a href="/Tour_management/modules/manager_home/manager_home.php">Thống Kê</a>
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

    <div class="container">
        <div class="row mt-4">
            <div class="col-6">
                <h2 class="text-primary fw-bold mb-4">Thêm Tour</h2>
            </div>

            <div class="col-6 text-end">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a type="button" class="btn btn-secondary" href="index.php">
                        <i class="fa-solid fa-circle-plus"></i>
                        Hủy
                    </a>

                    <button type="button" class="btn btn-primary">
                        <i class="fa fa-trash"></i>
                        Lưu
                    </button>

                </div>
            </div>
        </div>

        <form>
            <div class="form-group">
                <label for="exampleInputPassword1">Gói tour</label>
                <select class="form-control">
                    <option>Gói 1</option>
                    <option>Gói 2</option>
                    <option>Gói 3</option>
                </select>
            </div>
            <div class="form-group">
                <label class="mb-1 mt-3" for="exampleInputPassword1">Tên tour <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label class="mb-1 mt-3" for="exampleInputPassword1">Ngày bắt đầu <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label class="mb-1 mt-3" for="exampleInputPassword1">Ngày kết thúc <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label class="mb-1 mt-3" for="exampleInputPassword1">Giá <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label class="mb-1 mt-3" for="exampleInputPassword1">Mô tả</label>
                <textarea type="text" class="form-control" rows="10" id="exampleInputPassword1"></textarea>
            </div>

        </form>
    </div>


</div>

</body>
</html>
