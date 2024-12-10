<?php
class clsKetNoi {
    private $conn;

    function ketNoiDB() {
        $this->conn = new mysqli("localhost", "root", "", "ptud");

        // Kiểm tra kết nối
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function getConnection() {
        return $this->conn;
    }
}

$errors = array();

if (isset($_POST["create"])) {
    // Kết nối đến cơ sở dữ liệu
    $db = new clsKetNoi();
    $db->ketNoiDB();
    $conn = $db->getConnection();

    // Kiểm tra các trường nhập liệu
    if (empty($_POST["spotName"])) {
        $errors[] = "Vui lòng nhập tên điểm tham quan";
    }

    if (empty($_POST["startTime"])) {
        $errors[] = "Vui lòng nhập thời gian bắt đầu";
    }

    if (empty($_POST["endTime"])) {
        $errors[] = "Vui lòng nhập thời gian kết thúc";
    }

    if (empty($_POST["description"])) {
        $errors[] = "Vui lòng nhập mô tả";
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
        // Lưu trữ thông tin điểm tham quan
        $spot["spotName"] = htmlspecialchars($_POST["spotName"]);
        $spot["startTime"] = htmlspecialchars($_POST["startTime"]);
        $spot["endTime"] = htmlspecialchars($_POST["endTime"]);
        $spot["description"] = htmlspecialchars($_POST["description"]);
        $spot["image"] = $image_path; // Lưu đường dẫn hình ảnh

        // Tự động lấy mã gói tour lớn nhất và cộng thêm 1
        $result = $conn->query("SELECT MAX(tourPackageCode) AS max_code FROM sightseeingspot");
        $row = $result->fetch_assoc();
        $spot["tourPackageCode"] = $row['max_code'] ? $row['max_code'] + 1 : 1; // Nếu không có mã nào, bắt đầu từ 1

        // Lưu vehicleCode từ input
        $spot["vehicleCode"] = intval($_POST["vehicleCode"]);

        // Thêm điểm tham quan vào cơ sở dữ liệu
        $sql = "INSERT INTO sightseeingspot (spotName, startTime, endTime, description, image, tourPackageCode, vehicleCode) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssiii", $spot["spotName"], $spot["startTime"], $spot["endTime"], $spot["description"], $spot["image"], $spot["tourPackageCode"], $spot["vehicleCode"]);

        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                    window.location.href = "/path/to/your/redirect/page.php?message=Thêm điểm tham quan thành công";
                  </script>';
        } else {
            $errors[] = "Lỗi: " . $stmt->error;
        }

        $stmt->close();
    }
    $conn->close();
}

// Lấy danh sách phương tiện từ bảng vehicle
$db = new clsKetNoi();
$db->ketNoiDB();
$conn = $db->getConnection();
$vehicles = $conn->query("SELECT vehicleCode, vehicleName FROM vehicle");
?>

<div>
    <nav class="ms-2 mt-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/path/to/your/list/page.php">Danh sách điểm tham quan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới điểm tham quan</li>
        </ol>
    </nav>
    <div class="bg-white border-main">
        <div class="p-5">
            <div class="d-flex justify-content-center mt-3 mb-4">
                <h3>Thêm mới điểm tham quan</h3>
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
                    <label class="d-flex mb-2" for="spotName">Tên điểm tham quan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="spotName" id="spotName" placeholder="Tên điểm tham quan..."
                        <?php if (isset($_POST["spotName"])) echo 'value="'.htmlspecialchars($_POST["spotName"]).'"'; ?>>
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="startTime">Thời gian bắt đầu <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" name="startTime" id="startTime"
                        <?php if (isset($_POST["startTime"])) echo 'value="'.htmlspecialchars($_POST["startTime"]).'"'; ?>>
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="endTime">Thời gian kết thúc <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" name="endTime" id="endTime"
                        <?php if (isset($_POST["endTime"])) echo 'value="'.htmlspecialchars($_POST["endTime"]).'"'; ?>>
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="description">Mô tả</label>
                    <textarea class="form-control" name="description" id="description"><?php if (isset($_POST["description"])) echo htmlspecialchars($_POST["description"]); ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="vehicleCode">Phương tiện</label>
                    <select class="form-control" name="vehicleCode" id="vehicleCode">
                        <option value="">Chọn phương tiện</option>
                        <?php while ($vehicle = $vehicles->fetch_assoc()) { ?>
                            <option value="<?php echo $vehicle['vehicleCode']; ?>"><?php echo $vehicle['vehicleName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label class="d-flex mb-2" for="image">Hình ảnh</label>
                    <input type="file" class="form-control" name="image" id="image" accept="image/*">
                </div>
            </form>
        </div>
    </div>
</div>
