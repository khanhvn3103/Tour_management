<?php
$vehicleModel = new modelVehicle();
$employeeModel = new modelEmployee();
$tourPackageModel = new modelTourPackage();

$vehicles = $vehicleModel->selectAllVehicles();
$employees = $employeeModel->selectAllEmployees();
$tourPackages = $tourPackageModel->selectAllTourPackages();

if (isset($_GET['id'])) {
    $tourModel = new modelTour();
    $tourCode = $_GET['id'];
    $tour = $tourModel->getTourByCode($tourCode);
    if (!$tour) {
        echo "Tour không tồn tại.";
        exit;
    }
} else {
    echo "ID tour không hợp lệ.";
    exit;
}

$errors = array();

if (isset($_POST["update"])) {
    $tourName = $_POST["tourName"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $employeeCode = $_POST["employeeCode"];
    $vehicleCode = $_POST["vehicleCode"];
    $tourPackageCode = $_POST["tourPackageCode"];

    if (empty($tourName) || empty($startDate) || empty($endDate) || empty($price) || empty($description)) {
        $errors[] = "Vui lòng điền đầy đủ thông tin.";
    }

    if (empty($errors)) {

        if ($tourModel->updateTour($tourCode, $tourName, $startDate, $endDate, $price, $description, $employeeCode, $vehicleCode, $tourPackageCode)) {
            if (isset($_FILES['tourImages'])) {
                $targetDir = "assets/images/uploads/";
                $imagePaths = [];

                foreach ($_FILES['tourImages']['tmp_name'] as $key => $tmpName) {
                    if ($_FILES['tourImages']['error'][$key] == UPLOAD_ERR_OK) {
                        $targetFile = $targetDir . basename($_FILES["tourImages"]["name"][$key]);
                        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                        // Kiểm tra định dạng file ảnh
                        $check = getimagesize($tmpName);
                        if ($check !== false) {
                            // Di chuyển file ảnh vào thư mục uploads
                            move_uploaded_file($tmpName, $targetFile);
                            $imagePaths[] = $targetFile; // Lưu đường dẫn ảnh
                        } else {
                            $errors[] = "File không phải là hình ảnh.";
                        }
                    }
                }

                // Cập nhật đường dẫn ảnh vào cơ sở dữ liệu
                if (!empty($imagePaths)) {
                    $tourModel->insertTourImages($tourCode, $imagePaths);
                }
            }
            echo '<script>alert("Cập nhật tour thành công!"); window.location.href = "/Tour_management/modules/tour_manage/index.php";</script>';
        } else {
            $errors[] = "Lỗi khi cập nhật tour.";
        }
    }
}
?>

<div class="bg-white border-main">
    <div class="p-5">
        <h3>Cập nhật Tour</h3>
        <form action="" method="post">
            <div class="form-group mb-3">
                <label for="tourName">Tên Tour <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="tourName" id="tourName" value="<?php echo htmlspecialchars($tour['tourName']); ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="startDate">Ngày Bắt Đầu <span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" name="startDate" id="startDate" value="<?php echo date('Y-m-d\TH:i', strtotime($tour['startDate'])); ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="endDate">Ngày Kết Thúc <span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" name="endDate" id="endDate" value="<?php echo date('Y-m-d\TH:i', strtotime($tour['endDate'])); ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="price">Giá <span class="text-danger">*</span></label>
                <input type="number" step="0.01" class="form-control" name="price" id="price" value="<?php echo htmlspecialchars($tour['price']); ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Mô Tả</label>
                <textarea class="form-control" name="description" id="description"><?php echo htmlspecialchars($tour['description']); ?></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="vehicleCode">Chọn Phương Tiện</label>
                <select class="form-control" name="vehicleCode" id="vehicleCode">
                    <option value="">Chọn phương tiện</option>
                    <?php foreach ($vehicles as $vehicle): ?>
                        <option value="<?php echo $vehicle['vehicleCode']; ?>" <?php echo ($vehicle['vehicleCode'] == $tour['vehicleCode']) ? 'selected' : ''; ?>>
                            <?php echo $vehicle['vehicleName']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="employeeCode">Chọn Nhân Viên</label>
                <select class="form-control" name="employeeCode" id="employeeCode">
                    <option value="">Chọn nhân viên</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?php echo $employee['employeeCode']; ?>" <?php echo ($employee['employeeCode'] == $tour['employeeCode']) ? 'selected' : ''; ?>>
                            <?php echo $employee['username']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="tourPackageCode">Chọn Gói Tour</label>
                <select class="form-control" name="tourPackageCode" id="tourPackageCode">
                    <option value="">Chọn gói tour</option>
                    <?php foreach ($tourPackages as $tourPackage): ?>
                        <option value="<?php echo $tourPackage['tourPackageCode']; ?>" <?php echo ($tourPackage['tourPackageCode'] == $tour['tourPackageCode']) ? 'selected' : ''; ?>>
                            <?php echo $tourPackage['packageName']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Ảnh Cũ</label><br>
                <?php
                $tourImages = $tourModel->getTourImages($tourCode); // Lấy tất cả ảnh của tour
                if (!empty($tourImages)):
                    foreach ($tourImages as $image): ?>
                        <img src="<?php echo htmlspecialchars($image['image_path']); ?>" alt="Ảnh Tour" style="max-width: 200px; max-height: 150px; margin-right: 10px;">
                    <?php endforeach;
                else: ?>
                    <p>Không có ảnh nào.</p>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="tourImages">Cập Nhật Ảnh Tour</label>
                <input type="file" class="form-control" name="tourImages[]" id="tourImages" accept="image/*" multiple>
            </div>

            <button type="submit" class="btn btn-primary" name="update">Cập nhật</button>
            <?php if (!empty($errors)) { ?>
                <?php foreach ($errors as $error) {
                    echo "<div class='alert alert-danger' role='alert'>$error</div>";
                } ?>
            <?php } ?>
        </form>
    </div>
</div>
