<?php
$listPackageTour = new modelTourPackage();
$startingPoint = isset($_GET['startingPoint']) ? $_GET['startingPoint'] : '';
$destination = isset($_GET['destination']) ? $_GET['destination'] : '';
$duration = isset($_GET['duration']) ? $_GET['duration'] : '';
$numberOfPeople = isset($_GET['numberOfPeople']) ? $_GET['numberOfPeople'] : '';
$listTours = $listPackageTour->selectTourPackagesWithTours($startingPoint,$destination,$duration,$numberOfPeople);

?>
<section style="background: white" class="pb-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-3">
                <?php include 'modules/home/filter.php'; ?>
            </div>
            <div class="col-9">
                <div class="row">
                    <?php
                    foreach ($listTours as $tour) {
                        // Tính toán thời gian
                        $duration = $tour['maxEndDate'] ? (new DateTime($tour['maxEndDate']))->diff(new DateTime($tour['minStartDate']))->format('%d ngày %h giờ') : 'Chưa cập nhật';
                        ?>
                        <div class="col-4 mt-2">
                            <div class="card tour">
                                <div class="card-tour-img">
                                    <img src="<?php echo $tour['image'] ? '/Tour_management/modules/tour_package/' . $tour['image'] : '/Tour_management/asset/images/default-thumbnail.jpg'; ?>" alt="<?php echo $tour['packageName'] ?>">
                                </div>
                                <div class="card-body">
                                    <p class="duration">Thời lượng: <?php echo $duration ?></p>
                                    <h5 class="card-title" title="<?php echo $tour['packageName'] ?>"><?php echo $tour['packageName'] ?></h5>
                                    <p class="card-text">Điểm đi: <?php echo $tour['startingPoint'] ?></p>
                                    <p class="price">
                                        <i class="fa fa-tag me-2"></i>
                                        <?php
                                        echo number_format($tour['totalPrice'] ?? 0, 0, ',', '.') . ' VND';
                                        ?>
                                    </p>
                                    <div class="text-end">
                                        <a href="modules/home/tour_detail.php?code=<?php echo $tour['tourPackageCode']; ?>" class="btn btn-primary btn-detail">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
