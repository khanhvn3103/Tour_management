<?php

$tourModel = new modelTour();
$vehicleModel = new modelVehicle();

$tours = $tourModel->selectAllTours();
$vehicles = $vehicleModel->selectAllVehicles();

$spotModel = new modelSpot();
$errors = array();

if (isset($_GET['id'])) {
    $spotCode = $_GET['id'];
    $spot = $spotModel->getSpotByCode($spotCode);
    if (!$spot) {
        echo "Địa điểm không tồn tại.";
        exit;
    }
} else {
    echo "ID địa điểm không hợp lệ.";
    exit;
}

if (isset($_POST["update"])) {
    // Kiểm tra các trường nhập liệu
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

    // Xử lý upload hình ảnh
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $image_name = basename($_FILES["image"]["name"]);
        $upload_dir = "assets/images/uploads/";
        $image_path = $upload_dir . $image_name;

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (!move_uploaded_file($image_tmp_name, $image_path)) {
            $errors[] = "Không thể tải hình ảnh lên.";
        }
    } else {
        $image_path = $spot['image']; // Giữ nguyên ảnh cũ nếu không upload ảnh mới
    }

    if (empty($errors)) {
        // Chuyển đổi định dạng ngày tháng
        $startTime = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['startTime'])->format('Y-m-d H:i:s');
        $endTime = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['endTime'])->format('Y-m-d H:i:s');

        if ($spotModel->updateSpot($spotCode, $spotName, $startTime, $endTime, $description, $tourCode, $vehicleCode, $image_path)) {
            echo '<script type="text/javascript">
                    window.location.href = "/Tour_management/modules/sightseeing_spot/index.php?message=Cập nhật địa điểm thành công";
                  </script>';
        } else {
            $errors[] = "Lỗi khi cập nhật địa điểm.";
        }
    }
}
?>

<div>
    <nav class="ms-2 mt-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cập nhật địa điểm du lịch</li>
        </ol>
    </nav>
    <div class="bg-white border-main">
        <div class="p-5">
            <div class="d-flex justify-content-center mt-3 mb-4">
                <h3>Cập nhật địa điểm du lịch</h3>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="d-flex justify-content-end mb-3">
                    <a type="button" class="btn btn-secondary me-3" href="/path/to/your/list/page.php">Hủy <i class="fa-solid fa-xmark"></i></a>
                    <button type="submit" class="btn btn-primary" name="update">Cập nhật <i class="fa-solid fa-floppy-disk ms-2"></i></button>
                </div>
                <?php if (!empty($errors)) { ?>
                    <?php foreach ($errors as $error) {
                        echo "<div class='alert alert-danger' role='alert'>$error</div>";
                    } ?>
                <?php } ?>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="spotName">Tên Địa Điểm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="spotName" id="spotName" placeholder="Tên địa điểm..."
                        value="<?php echo htmlspecialchars($spot['spotName']); ?>">
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="startTime">Thời Gian Bắt Đầu <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" name="startTime" id="startTime"
                        value="<?php echo date('Y-m-d\TH:i', strtotime($spot['startTime'])); ?>">
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="endTime">Thời Gian Kết Thúc <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" name="endTime" id="endTime"
                        value="<?php echo date('Y-m-d\TH:i', strtotime($spot['endTime'])); ?>">
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="description">Mô Tả <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" id="description"><?php echo htmlspecialchars($spot['description']); ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="tourCode">Chọn Tour</label>
                    <select class="form-control" name="tourCode" id="tourCode">
                        <option value="">Chọn tour</option>
                        <?php foreach ($tours as $tour): ?>
                            <option value="<?php echo $tour['tourCode']; ?>" <?php echo ($tour['tourCode'] == $spot['tourCode']) ? 'selected' : ''; ?>>
                                <?php echo $tour['tourName']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="vehicleCode">Chọn Phương Tiện</label>
                    <select class="form-control" name="vehicleCode" id="vehicleCode">
                        <option value="">Chọn phương tiện</option>
                        <?php foreach ($vehicles as $vehicle): ?>
                            <option value="<?php echo $vehicle['vehicleCode']; ?>" <?php echo ($vehicle['vehicleCode'] == $spot['vehicleCode']) ? 'selected' : ''; ?>>
                                <?php echo $vehicle['vehicleName']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="image">Hình Ảnh</label>
                    <input type="file" class="form-control" name="image" id="image" accept=".jpg,.jpeg,.png,.gif">
                </div>
                <?php if (!empty($spot['image'])): ?>
                    <div class="mb-3">
                        <h5>Ảnh hiện tại:</h5>
                        <img src="<?php echo $spot['image']; ?>" alt="Current Image" style="max-width: 200px; max-height: 200px;">
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
