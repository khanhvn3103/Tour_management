<?php
if (isset($_GET['id'])) {
    $tourModel = new modelTourPackage();
    $tourPackageCode = $_GET['id'];
    $tourPackage = $tourModel->getTourPackageByCode($tourPackageCode);

    if (!$tourPackage) {
        echo "Gói tour không tồn tại.";
        exit;
    }
} else {
    echo "ID gói tour không hợp lệ.";
    exit;
}

$errors = array();

if (isset($_POST["update"])) {
    // Kiểm tra các trường nhập liệu
    $requiredFields = [
        "packageName" => "Vui lòng nhập tên gói tour",
        "startingPoint" => "Vui lòng nhập điểm khởi hành",
        "endPoint" => "Vui lòng nhập điểm đến",
        "description" => "Vui lòng nhập mô tả"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            $errors[] = $errorMessage;
        }
    }

    // Kiểm tra upload hình ảnh
    $image_path = $tourPackage['image']; // Giữ nguyên hình ảnh cũ
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
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
    }

    if (empty($errors)) {
        $packageName = htmlspecialchars($_POST["packageName"]);
        $startingPoint = htmlspecialchars($_POST["startingPoint"]);
        $endPoint = htmlspecialchars($_POST["endPoint"]);
        $description = htmlspecialchars($_POST["description"]);

        if ($tourModel->updateTourPackage($tourPackageCode, $packageName, $startingPoint, $endPoint, $description, $image_path)) {
            echo '<script type="text/javascript">
                    window.location.href = "/Tour_management/modules/tour_package/index.php?message=Cập nhật gói tour thành công";
                  </script>';
        } else {
            $errors[] = "Lỗi khi cập nhật gói tour.";
        }
    }
}
?>

<div class="bg-white border-main">
    <div class="p-5">
        <h3>Cập nhật gói tour</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="packageName">Tên gói tour <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="packageName" id="packageName" value="<?php echo htmlspecialchars($tourPackage['packageName']); ?>">
            </div>
            <div class="form-group mb-3">
                <label for="startingPoint">Điểm khởi hành <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="startingPoint" id="startingPoint" value="<?php echo htmlspecialchars($tourPackage['startingPoint']); ?>">
            </div>
            <div class="form-group mb-3">
                <label for="endPoint">Điểm đến <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="endPoint" id="endPoint" value="<?php echo htmlspecialchars($tourPackage['endPoint']); ?>">
            </div>
            <div class="form-group mb-3">
                <label for="description">Mô tả</label>
                <textarea class="form-control" name="description" id="description"><?php echo htmlspecialchars($tourPackage['description']); ?></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="image">Hình ảnh hiện tại</label><br>
                <img src="<?php echo $tourPackage['image'] ? '/Tour_management/modules/tour_package/' . $tourPackage['image'] : '/Tour_management/asset/images/default-thumbnail.jpg'; ?>" alt="Hình ảnh gói tour" width="200px" class="mb-3"/>
                <label for="image">Chọn hình ảnh mới (nếu có)</label>
                <input type="file" class="form-control" name="image" id="image" accept="image/*">
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
