<?php

$errors = array();

if (isset($_POST["create"])) {
    // Tạo đối tượng modelTourPackage
    $tourModel = new modelTourPackage();

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
        // Lưu trữ thông tin gói tour
        $packageName = htmlspecialchars($_POST["packageName"]);
        $startingPoint = htmlspecialchars($_POST["startingPoint"]);
        $endPoint = htmlspecialchars($_POST["endPoint"]);
        $description = htmlspecialchars($_POST["description"]);

        $result = $tourModel->selectAllTourPackages();

        if ($tourModel->insertTourPackage($packageName, $startingPoint, $endPoint, $description, $image_path)) {
            echo '<script type="text/javascript">
                    window.location.href = "/Tour_management/modules/tour_package/index.php?message=Thêm gói tour thành công";
                  </script>';
        } else {
            $errors[] = "Lỗi khi thêm gói tour.";
        }
    }
}
?>

<div>
    <nav class="ms-2 mt-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/path/to/your/list/page.php">Danh sách gói tour</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới gói tour</li>
        </ol>
    </nav>
    <div class="bg-white border-main">
        <div class="p-5">
            <div class="d-flex justify-content-center mt-3 mb-4">
                <h3>Thêm mới gói tour</h3>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="d-flex justify-content-end mb-3">
                    <a type="button" class="btn btn-secondary me-3" href="/path/to/your/list/page.php">Hủy <i class="fa-solid fa-xmark"></i></a>
                    <button type="submit" class="btn btn-primary" name="create">Lưu <i class="fa-solid fa-floppy-disk ms-2"></i></button>
                </div>
                <?php if (!empty($errors)) { ?>
                    <?php foreach ($errors as $error) {
                        echo "<div class='alert alert-danger' role='alert'>$error</div>";
                    } ?>
                <?php } ?>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="packageName">Tên gói tour <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="packageName" id="packageName" placeholder="Tên gói tour..."
                        <?php if (isset($_POST["packageName"])) echo 'value="'.htmlspecialchars($_POST["packageName"]).'"'; ?>>
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="startingPoint">Điểm khởi hành <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="startingPoint" id="startingPoint"
                        <?php if (isset($_POST["startingPoint"])) echo 'value="'.htmlspecialchars($_POST["startingPoint"]).'"'; ?>>
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="endPoint">Điểm đến <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="endPoint" id="endPoint"
                        <?php if (isset($_POST["endPoint"])) echo 'value="'.htmlspecialchars($_POST["endPoint"]).'"'; ?>>
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="description">Mô tả</label>
                    <textarea class="form-control" name="description" id="description"><?php if (isset($_POST["description"])) echo htmlspecialchars($_POST["description"]); ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="image">Hình ảnh</label>
                    <input type="file" class="form-control" name="image" id="image" accept="image/*">
                </div>
            </form>
        </div>
    </div>
</div>
