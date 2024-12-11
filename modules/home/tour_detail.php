<?php
// Get the tour code from the URL
$tourCode = isset($_GET['code']) ? $_GET['code'] : '';

// Kết nối đến cơ sở dữ liệu
include_once("../../models/clsKetNoi.php");
$p = new clsKetNoi();
$conn = $p->ketNoiDB();

// Truy vấn thông tin gói tour
//$queryTour = "SELECT * FROM tourpackage WHERE tourPackageCode = ?";
//$stmtTour = $conn->prepare($queryTour);
//$stmtTour->bind_param("s", $tourCode);
//$stmtTour->execute();
//$resultTour = $stmtTour->get_result();
//$selectedTour = $resultTour->fetch_assoc();
$queryTimeTour = "
        SELECT tp.tourPackageCode, tp.packageName, tp.startingPoint, tp.image, tp.description,
                MIN(t.startDate) AS minStartDate, MAX(t.endDate) AS maxEndDate,
               SUM(t.price) AS totalPrice
        FROM tourpackage tp
        LEFT JOIN tour t ON tp.tourPackageCode = t.tourPackageCode
        WHERE tp.tourPackageCode = " . $tourCode ."
        GROUP BY tp.tourPackageCode
    ";
$resultTimeTour = $conn->query($queryTimeTour);
$selectedTour = $resultTimeTour->fetch_assoc();
// Nếu tour không tồn tại
if (!$selectedTour) {
    echo "<h1>Tour không tồn tại!</h1>";
    exit;
}



//while () {
//    $tourTimePackages[] = $row;
//}

// Truy vấn thông tin phương tiện
$queryVehicle = "SELECT * FROM vehicle WHERE vehicleCode = ?";
$stmtVehicle = $conn->prepare($queryVehicle);
$stmtVehicle->bind_param("i", $selectedTour['vehicleCode']);
$stmtVehicle->execute();
$resultVehicle = $stmtVehicle->get_result();
$vehicle = $resultVehicle->fetch_assoc();

// Truy vấn thông tin địa điểm tham quan
$querySightseeing = "SELECT * FROM sightseeingspot WHERE tourPackageCode = ?";
$stmtSightseeing = $conn->prepare($querySightseeing);
$stmtSightseeing->bind_param("i", $tourCode);
$stmtSightseeing->execute();
$resultSightseeing = $stmtSightseeing->get_result();
$sightseeingSpots = $resultSightseeing->fetch_all(MYSQLI_ASSOC);

// Đóng kết nối
//$stmtTour->close();
$stmtVehicle->close();
$stmtSightseeing->close();
$p->closeKetNoi($conn);

//var_dump($selectedTour['image']);
//die();
$duration = $selectedTour['maxEndDate'] ? (new DateTime($selectedTour['maxEndDate']))->diff(new DateTime($selectedTour['minStartDate']))->format('%d ngày %h giờ') : 'Chưa cập nhật';

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $selectedTour['packageName']; ?></title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Tour_management/asset/css/style.css">
</head>
<body>
<section class="tour-detail pb-5">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6">
                <img src="<?php echo $selectedTour['image'] ? '/Tour_management/modules/tour_package/' . $selectedTour['image'] : '/Tour_management/asset/images/default-thumbnail.jpg'; ?>" class="img-fluid mb-3" alt="<?php echo $selectedTour['packageName']; ?>">
            </div>

            <div class="col-md-6">
                <h1><?php echo $selectedTour['packageName']; ?></h1>
                <p><strong>Thời gian:</strong> <?php echo $duration; ?></p>
                <p><strong>Điểm khởi hành:</strong> <?php echo $selectedTour['startingPoint']; ?></p>
                <p><strong>Giá:</strong> <?php echo number_format($tour['totalPrice'] ?? 0, 0, ',', '.') . ' VND'; ?></p>
                <p><?php echo $selectedTour['description']; ?></p>

                <p><strong>Phương tiện:</strong> <?php echo $vehicle['vehicleName'] ?? 'Chưa cập nhật'; ?></p>

                <form action="booking.php" method="POST">
                    <input type="hidden" name="tour_code" value="<?php echo $selectedTour['tourPackageCode']; ?>">
                    <div class="mb-3">
                        <label for="adults" class="form-label">Số người lớn:</label>
                        <input type="number" id="adults" name="adults" class="form-control" value="1" min="1">
                    </div>
                    <div class="mb-3">
                        <label for="children" class="form-label">Số trẻ em (dưới 14 tuổi):</label>
                        <input type="number" id="children" name="children" class="form-control" value="0" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Chọn ngày khởi hành:</label>
                        <input type="date" id="date" name="date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Đặt Tour</button>
                </form>

            </div>
        </div>

        <!-- Detailed Description Section -->
        <div class="row mt-5">
            <div class="col-12">
                <h3>Các địa điểm tham quan</h3>
                <ul>
                    <?php foreach ($sightseeingSpots as $spot) { ?>
                        <li>
                            <img src="<?php echo $spot['image'] ? '/Tour_management/modules/sightseeing_spot/' . $spot['image'] : '/Tour_management/asset/images/default-thumbnail.jpg'; ?>" alt="<?php echo $spot['spotName']; ?>" class="img-fluid" style="max-width: 200px;">
                            <br>
                            <strong>Địa điểm: <?php echo $spot['spotName']; ?></strong>
                            <br>
                            Thời gian từ: <?php echo date('d/m/Y H:i', strtotime($spot['startTime'])); ?> đến <?php echo date('d/m/Y H:i', strtotime($spot['endTime'])); ?>:
                            <br>
                            Mô tả: <?php echo $spot['description']; ?>
                        </li>
                    <?php } ?>
                </ul>
                <p><?php echo nl2br($selectedTour['description']); ?></p>
            </div>
        </div>
    </div>
</section>

<footer class="footer bg-body border-top" data-bs-theme="dark">
    <div class="container pb-md-2">
        <div class="row">
            <div class="col-3">
                <div class="d-flex align-content-center justify-content-around">
                    <i class="fa fa-github"></i>
                </div>
            </div>
            <div class="col-3">
                <h5 class="text-white font-weight-bold">Thông tin</h5>
                <span class="text-white">Giới thiệu</span>
            </div>
            <div class="col-5">
                <h5 class="text-white font-weight-bold">Liên hệ</h5>
                <div class="text-white">
                    <i class="fa fa-phone"></i>
                    1900 6420
                </div>
                <div class="text-white">
                    <i class="fa fa-location-dot"></i>
                    12 Nguyễn Văn Bảo, Phường 12, Quân Gò Vấp, TPHCM
                </div>
                <div class="text-white">
                    <i class="fa fa-envelope"></i>
                    travellowkey@gmail.com
                </div>
            </div>
            <div class="col-12 border-top mt-3 pt-3 text-center">
                <p class="text-body-secondary mb-0">
                    © All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
<script src="/Tour_management/asset/js/jquery-3.7.1.js"></script>
<script src="/Tour_management/asset/js/sweetalert2@11.min.js"></script>
<script src="/Tour_management/asset/js/bootstrap.bundle.min.js"></script>
</body>
</html>
