<?php
$listTour = new modelTour(); // Đổi tên biến từ listPackageTour thành listTour
$startingPoint = isset($_GET['startingPoint']) ? $_GET['startingPoint'] : '';
$destination = isset($_GET['destination']) ? $_GET['destination'] : '';
$duration = isset($_GET['duration']) ? $_GET['duration'] : '';
$numberOfPeople = isset($_GET['numberOfPeople']) ? $_GET['numberOfPeople'] : '';
$listTours = $listTour->selectAllTours(); // Gọi phương thức để lấy danh sách tour

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
                        if(count($listTours) > 0){
                            foreach ($listTours as $tour) {
                                // Tính toán thời gian
                                $duration = $tour['endDate'] ? (new DateTime($tour['endDate']))->diff(new DateTime($tour['startDate']))->format('%d ngày %h giờ') : 'Chưa cập nhật';
                                $image = $listTour->getTourOneImages($tour['tourCode']);
                                ?>
                                <div class="col-4 mt-2">
                                    <div class="card tour">
                                        <div class="card-tour-img">
                                            <img src="<?php echo $image ? '/Tour_management/modules/tour_manage/' . $image : '/Tour_management/asset/images/default-thumbnail.jpg'; ?>" alt="<?php echo $tour['tourName'] ?>">
                                        </div>
                                        <div class="card-body">
                                            <p class="duration">Thời lượng: <?php echo $duration ?></p>
                                            <h5 class="card-title" title="<?php echo $tour['tourName'] ?>"><?php echo $tour['tourName'] ?></h5>
                                            <!--                                    <p class="card-text">Điểm đi: --><?php //echo $tour['startingPoint'] ?><!--</p>-->
                                            <p class="price">
                                                <i class="fa fa-tag me-2"></i>
                                                <?php
                                                echo number_format($tour['price'] ?? 0, 0, ',', '.') . ' VND';
                                                ?>
                                            </p>
                                            <div class="text-end">
                                    <a href="modules/home/tour_detail.php?tourCode=<?php echo $tour['tourCode']; ?>" class="btn btn-primary btn-detail">Xem chi tiết</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }else{
                            ?>
                            <div class="col-12 d-flex flex-column justify-content-center align-items-center pt-5">
                                <img src="/Tour_management/asset/images/tours/empty.png">
                                <p class="text-secondary">Chưa có tour phù hợp với bạn</p>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
