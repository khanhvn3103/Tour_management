<?php
$tourModel = new modelTour();
$vehicleModel = new modelVehicle();

$tours = $tourModel->selectAllTours();
$vehicles = $vehicleModel->selectAllVehicles();

$errors = array();

if (isset($_POST["add"])) {
    // Tạo đối tượng modelSpot
    $spotModel = new modelSpot();

    // Kiểm tra các trường nhập liệu bắt buộc
    $requiredFields = [
        "spotName" => "Vui lòng nhập tên địa điểm",
        "startTime" => "Vui lòng nhập thời gian bắt đầu",
        "endTime" => "Vui lòng nhập thời gian kết thúc",
        "description" => "Vui lòng nhập mô tả"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            $errors[] = $errorMessage;
        }
    }

    // Kiểm tra upload hình ảnh
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $image_name = basename($_FILES["image"]["name"]);
        $upload_dir = "assets/images/uploads/";
        $image_path = $upload_dir . $image_name;

        // Kiểm tra nếu thư mục tồn tại, nếu không thì tạo mới
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Di chuyển hình ảnh vào thư mục
        if (!move_uploaded_file($image_tmp_name, $image_path)) {
            $errors[] = "Không thể tải hình ảnh lên.";
        }
    } else {
        $errors[] = "Vui lòng chọn hình ảnh.";
    }

    if (empty($errors)) {
        // Lưu trữ thông tin địa điểm
        $spotName = htmlspecialchars($_POST["spotName"]);
        $startTime = htmlspecialchars($_POST["startTime"]);
        $endTime = htmlspecialchars($_POST["endTime"]);
        $description = htmlspecialchars($_POST["description"]);
        $tourCode = htmlspecialchars($_POST["tourCode"]);
        $vehicleCode = htmlspecialchars($_POST["vehicleCode"]);
        $startTime = DateTime::createFromFormat('Y-m-d\TH:i', $startTime)->format('Y-m-d H:i:s');
        $endTime = DateTime::createFromFormat('Y-m-d\TH:i', $endTime)->format('Y-m-d H:i:s');

        if ($spotModel->insertSpot($spotName, $startTime, $endTime, $description, $tourCode, $vehicleCode, $image_path)) {
            echo '<script type="text/javascript">
                    window.location.href = "/Tour_management/modules/sightseeing_spot/index.php?message=Thêm địa điểm thành công";
                  </script>';
        } else {
            $errors[] = "Lỗi khi thêm địa điểm.";
        }
    }
}
?>

<div>
    <nav class="ms-2 mt-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới địa điểm du lịch</li>
        </ol>
    </nav>
    <div class="bg-white border-main">
        <div class="p-5">
            <div class="d-flex justify-content-center mt-3 mb-4">
                <h3>Thêm mới địa điểm du lịch</h3>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <?php if (!empty($errors)) { ?>
                    <?php foreach ($errors as $error) {
                        echo "<div class='alert alert-danger' role='alert'>$error</div>";
                    } ?>
                <?php } ?>
                <div class="form-group mb-2">
                    <label class="d-flex mb-2" for="spotName">Tên Địa Điểm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="spotName" id="spotName" placeholder="Tên địa điểm"
                        <?php if (isset($_POST["spotName"])) echo 'value="'.htmlspecialchars($_POST["spotName"]).'"'; ?>>
                </div>

                <div class='row'>
                    <div class="col-6">
                        <div class="form-group mb-2">
                            <label class="d-flex mb-2" for="startTime">Thời Gian Bắt Đầu <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" name="startTime" id="startTime"
                                <?php if (isset($_POST["startTime"])) echo 'value="'.htmlspecialchars($_POST["startTime"]).'"'; ?>>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-2">
                            <label class="d-flex mb-2" for="endTime">Thời Gian Kết Thúc <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" name="endTime" id="endTime"
                                <?php if (isset($_POST["endTime"])) echo 'value="'.htmlspecialchars($_POST["endTime"]).'"'; ?>>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label class="d-flex mb-2" for="description">Mô Tả <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" id="description" placeholder="Nhập mô tả"><?php if (isset($_POST["description"])) echo htmlspecialchars($_POST["description"]); ?></textarea>
                </div>
                <div class="form-group mb-2">
                    <label class="d-flex mb-2" for="tourCode">Chọn Tour</label>
                    <select class="form-control" name="tourCode" id="tourCode">
                        <option value="">Chọn tour</option>
                        <?php foreach ($tours as $tour): ?>
                            <option value="<?php echo $tour['tourCode']; ?>"><?php echo $tour['tourName']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label class="d-flex mb-2" for="vehicleCode">Chọn Phương Tiện</label>
                    <select class="form-control" name="vehicleCode" id="vehicleCode">
                        <option value="">Chọn phương tiện</option>
                        <?php foreach ($vehicles as $vehicle): ?>
                            <option value="<?php echo $vehicle['vehicleCode']; ?>"><?php echo $vehicle['vehicleName']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label class="d-flex mb-2" for="image">Hình Ảnh <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="image" id="image" accept=".jpg,.jpeg,.png,.gif">
                </div>
                <div class="d-flex justify-content-end my-2">
                    <a type="button" class="btn btn-secondary me-1" href="/path/to/your/list/page.php">Hủy <i class="fa-solid fa-xmark"></i></a>
                    <button type="submit" class="btn btn-primary" name="add">Lưu <i class="fa-solid fa-floppy-disk ms-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
