<?php
$errors = array();

$vehicleModel = new modelVehicle();
$employeeModel = new modelEmployee();
$tourPackageModel = new modelTourPackage();

$vehicles = $vehicleModel->selectAllVehicles();
$employees = $employeeModel->selectAllEmployees();
$tourPackages = $tourPackageModel->selectAllTourPackages();

if (isset($_POST["create"])) {
    // Lấy giá trị từ form
    $tourName = $_POST['tourName'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $employeeCode = $_POST['employeeCode'];
    $vehicleCode = $_POST['vehicleCode'];
    $tourPackageCode = $_POST['tourPackageCode'];

    // Chuyển đổi định dạng ngày tháng
    $startDateTime = DateTime::createFromFormat('Y-m-d\TH:i', $startDate);
    $endDateTime = DateTime::createFromFormat('Y-m-d\TH:i', $endDate);

    // Kiểm tra xem các giá trị có hợp lệ không
    if ($startDateTime && $endDateTime) {
        // Chuyển đổi sang định dạng MySQL
        $startDate = $startDateTime->format('Y-m-d H:i:s');
        $endDate = $endDateTime->format('Y-m-d H:i:s');

        // Kiểm tra lại giá trị trước khi chèn vào DB
        if ($startDate && $endDate) {
            // Kiểm tra xem startDate có lớn hơn endDate không
            if ($startDateTime <= $endDateTime) {
                $db = new modelTour();

                // Thêm tour vào cơ sở dữ liệu và lấy tourCode
                if ($db->insertTour($tourName, $startDate, $endDate, (float)$price, $description, $employeeCode, $vehicleCode, $tourPackageCode)) {
                    $tourCode = $db->getConnection()->insert_id; // Lấy tourCode vừa thêm

                    // Xử lý upload ảnh
                    if (!empty($_FILES['images']['name'][0])) {
                        $imagePaths = [];
                        $uploadDir = 'assets/images/uploads/'; // Đường dẫn tới thư mục upload

                        foreach ($_FILES['images']['name'] as $key => $imageName) {
                            $tmpName = $_FILES['images']['tmp_name'][$key];
                            $newFileName = uniqid() . '-' . basename($imageName);
                            $uploadFilePath = $uploadDir . $newFileName;

                            if (move_uploaded_file($tmpName, $uploadFilePath)) {
                                $imagePaths[] = $uploadFilePath; // Lưu đường dẫn ảnh vào mảng
                            } else {
                                $errors[] = "Lỗi khi upload ảnh: " . $imageName;
                            }
                        }

                        // Lưu đường dẫn ảnh vào cơ sở dữ liệu
                        if (!$db->insertTourImages($tourCode, $imagePaths)) {
                            $errors[] = "Lỗi khi lưu ảnh vào cơ sở dữ liệu.";
                        }
                    }

                    echo '<script>alert("Thêm tour thành công!"); window.location.href = "/Tour_management/modules/tour_manage/index.php";</script>';
                } else {
                    $errors[] = "Lỗi khi thêm tour: " . mysqli_error($db->getConnection());
                }
            } else {
                $errors[] = "Ngày bắt đầu không thể lớn hơn ngày kết thúc.";
            }
        } else {
            $errors[] = "Giá trị ngày tháng không hợp lệ.";
        }
    } else {
        $errors[] = "Định dạng ngày tháng không hợp lệ.";
    }
}
?>

<div class="bg-white border-main">
    <div class="p-5">
        <h3>Thêm Tour</h3>
        <form action="" method="post" enctype="multipart/form-data"> <!-- Thêm enctype cho upload file -->
            <div class="form-group mb-3">
                <label for="tourName">Tên Tour <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="tourName" id="tourName" required>
            </div>
            <div class="form-group mb-3">
                <label for="startDate">Ngày Bắt Đầu <span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" name="startDate" id="startDate" required>
            </div>
            <div class="form-group mb-3">
                <label for="endDate">Ngày Kết Thúc <span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" name="endDate" id="endDate" required>
            </div>
            <div class="form-group mb-3">
                <label for="price">Giá <span class="text-danger">*</span></label>
                <input type="number" step="0.01" class="form-control" name="price" id="price" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Mô Tả</label>
                <textarea class="form-control" name="description" id="description"></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="vehicleCode">Chọn Phương Tiện</label>
                <select class="form-control" name="vehicleCode" id="vehicleCode">
                    <option value="">Chọn phương tiện</option>
                    <?php foreach ($vehicles as $vehicle): ?>
                        <option value="<?php echo $vehicle['vehicleCode']; ?>"><?php echo $vehicle['vehicleName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="employeeCode">Chọn Nhân Viên</label>
                <select class="form-control" name="employeeCode" id="employeeCode">
                    <option value="">Chọn nhân viên</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?php echo $employee['employeeCode']; ?>"><?php echo $employee['username']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="tourPackageCode">Chọn Gói Tour</label>
                <select class="form-control" name="tourPackageCode" id="tourPackageCode">
                    <option value="">Chọn gói tour</option>
                    <?php foreach ($tourPackages as $tourPackage): ?>
                        <option value="<?php echo $tourPackage['tourPackageCode']; ?>"><?php echo $tourPackage['packageName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="images">Chọn Hình Ảnh</label>
                <input type="file" class="form-control" name="images[]" id="images" multiple accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary" name="create">Thêm</button>
            <?php if (!empty($errors)) { ?>
                <?php foreach ($errors as $error) {
                    echo "<div class='alert alert-danger' role='alert'>$error</div>";
                } ?>
            <?php } ?>
        </form>
    </div>
</div>
