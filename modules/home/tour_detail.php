<?php
    include("../../models/tourConnect.php");
    $tour = new modelTour();
        
    $get_tourCode = isset($_GET['tourCode']) ? (int)$_GET['tourCode'] : 0;
    $tour_inforDetail = $tour->getTour($get_tourCode);    
    
    // tính số ngày
    $startDate = new DateTime(htmlspecialchars($tour_inforDetail['startDate']));
    $endDate = new DateTime(htmlspecialchars($tour_inforDetail['endDate']));

    // Tính số ngày giữa startDate và endDate
    $interval = $startDate->diff($endDate);
    
    // tourPlan
    include ("../../models/tourPlanConnect.php");
    $touPlan = new modelTourPlan();
    $info_tourPlan = $touPlan->getTourPlan($get_tourCode);
    
    // tour_gallery
    $tour_gallery = $tour->show_gallery($get_tourCode);

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $selectedTour->name; ?></title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Tour_management/asset/css/style.css">
    <link rel="stylesheet" href="/Tour_management/asset/css/tourDetail.css">
</head>
<body>
    <!-- section-1 -->
    <div class="divImage">
        <img src="<?= htmlspecialchars($tour_inforDetail['tourImage']) ?>" alt="">
        <div class="Slogan">
            <h1>TRẢI NGHIỆM CÙNG VỚI</h1>
            <h2 class="text-uppercase fw-bold"><?= htmlspecialchars($tour_inforDetail['tourName']) ?></h2>
        </div>
    </div>
    
    <section class="tour-detail pb-5" style="transform: translateY(-80px);">
        <div class="container">
            <div class="content">
                <!-- sidebar -->
                <div class="row">
                    <div class="row row-tab col" id="myTab" role="tablist">
                        <a href="#tab1" id="tab1-tab" data-bs-toggle="tab" role="tab" aria-controls="tab1"
                            aria-selected="true" class="tab-item active col fw-bold text-decoration-none">
                            <i class="fa-solid fa-circle-info me-2"></i>Thông tin 
                        </a>

                        <a href="#tab2" id="tab2-tab" data-bs-toggle="tab" role="tab" aria-controls="tab2"
                            aria-selected="false" class="tab-item col fw-bold text-decoration-none">
                            <i class="fa-solid fa-calendar-days me-2"></i>Lịch trình
                        </a>

                        <a href="#tab3" id="tab3-tab" data-bs-toggle="tab" role="tab" aria-controls="tab3"
                            aria-selected="false" class="tab-item col fw-bold text-decoration-none">
                            <i class="fa-solid fa-name-dot me-2"></i>Địa điểm
                        </a>

                        <a href="#tab4" id="tab4-tab" data-bs-toggle="tab" role="tab" aria-controls="tab4"
                            aria-selected="false" class="tab-item col fw-bold text-decoration-none">
                            <i class="fa-solid fa-camera me-2"></i>Sưu tầm
                        </a>
                    </div>
                    <div class="col-xl-4 d-xl-flex d-lg-none not-used"></div>
                </div>
                
                <!-- content -->
                <div class="row py-5 row-content-tab">
                    <div class="col-xl-8 col-lg-8 col-md-12">
                        <div class="tab-content px-xl-5 px-lg-5 px-md-3 px-sm-0">
                            
                            <!-- tab-infor -->
                            <div class="tab-infor tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                <div class="name">
                                    <p class="h2 text-uppercase"><?= htmlspecialchars($tour_inforDetail['tourName'])?></p>
                                </div>
                                <div class="price">
                                    <p class="mb-0">
                                        <span><?= number_format(htmlspecialchars($tour_inforDetail['price']), 0, ',', '.') ?> VND</span>
                                        <small>/ <?= $interval->days . " ngày"; ?></small>
                                    </p>
                                </div>
                                <div class="decs py-4">
                                    <p class="text"><?= htmlspecialchars($tour_inforDetail['description'])?></p>
                                </div>
                                <div class="btn-group">
                                    <div class="day d-flex align-items-center justify-content-center">
                                        <i class="fa-regular fa-calendar me-2"></i>5
                                    </div>
                                    <div class="age d-flex align-items-center justify-content-center">
                                        <i class="fa-regular fa-user me-2"></i>15+
                                    </div>
                                </div>
                            </div>
                            
                            <!-- tab-content-2 -->
                            <div class="tab-plane tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                <div class="tour-plane">
                                   <!-- Accordion -->
                                    <div class="accordion" id="tourPlanAccordion">
                                        <!-- step-1 -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading1">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                    Lịch Trình 1:
                                                </button>
                                            </h2>
                                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#tourPlanAccordion">
                                                <div class="accordion-body">
                                                    <div class="tour-plane">
                                                        <!-- step-1 content -->
                                                        <div class="plane step-1">
                                                            <div class="row-head">
                                                                <div class="box">
                                                                    <div class="inner-box">1</div>
                                                                </div>
                                                                <div class="line">
                                                                    <span class="inner-line"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row-text">
                                                                <div class="box-text">
                                                                    <p>
                                                                        <?= htmlspecialchars_decode($info_tourPlan['tourPlan1']) ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- step-2 -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading2">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                    Lịch Trình 2:
                                                </button>
                                            </h2>
                                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#tourPlanAccordion">
                                                <div class="accordion-body">
                                                    <div class="tour-plane">
                                                        <!-- step-2 content -->
                                                        <div class="plane step-2">
                                                            <div class="row-head">
                                                                <div class="box">
                                                                    <div class="inner-box">2</div>
                                                                </div>
                                                                <div class="line">
                                                                    <span class="inner-line"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row-text">
                                                                <div class="box-text">
                                                                    <p>
                                                                        <?= htmlspecialchars_decode($info_tourPlan['tourPlan2']) ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- step-3 -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading3">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                                    Lịch Trình 3:
                                                </button>
                                            </h2>
                                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#tourPlanAccordion">
                                                <div class="accordion-body">
                                                    <div class="tour-plane">
                                                        <!-- step-3 content -->
                                                        <div class="plane step-3">
                                                            <div class="row-head">
                                                                <div class="box">
                                                                    <div class="inner-box">3</div>
                                                                </div>
                                                                <div class="line">
                                                                    <span class="inner-line"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row-text">
                                                                <div class="box-text">
                                                                    <p>
                                                                        <?= htmlspecialchars_decode($info_tourPlan['tourPlan3']) ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- step-4 -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading2">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                    Lịch Trình 4:
                                                </button>
                                            </h2>
                                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#tourPlanAccordion">
                                                <div class="accordion-body">
                                                    <div class="tour-plane">
                                                        <!-- step-2 content -->
                                                        <div class="plane step-2">
                                                            <div class="row-head">
                                                                <div class="box">
                                                                    <div class="inner-box">4</div>
                                                                </div>
                                                                <div class="line">
                                                                    <span class="inner-line"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row-text">
                                                                <div class="box-text">
                                                                    <p>
                                                                        <?= htmlspecialchars_decode($info_tourPlan['tourPlan4']) ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- tab-content-3 -->
                            <div class="tour-location tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                <p class="h2 text-uppercase">ĐỊA ĐIỂM THAM QUAN</p>
                                <p>
                                
                                </p>
                                <div class="map-container">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d238637.48341190434!2d106.98481534247551!3d20.84338647575843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a5796518cee87%3A0x55c6b0bcc85478db!2zVuG7i25oIEjhuqEgTG9uZw!5e0!3m2!1svi!2s!4v1721747579200!5m2!1svi!2s"  
                                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                    <a class="zoom-button" href="https://www.google.com/maps?q=20.84338647575843,106.98481534247551&hl=vi" target="_blank"><i class="fa-solid fa-magnifying-glass-plus fw-bold"></i></a>
                                </div>
                            </div>
                            
                            <!-- tab-content-4 -->
                            <div class="tour-gallery tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                                <p class="h2 text-uppercase">HÌNH ẢNH ĐỊA ĐIỂM</p>
                                <div class="images">
                                    <!-- 1 -->
                                    <div class="item">
                                        <img src="<?= htmlspecialchars($tour_gallery['gallery1']) ?>" alt="">
                                    </div>
                                    
                                    <!-- 2 -->
                                    <div class="item">
                                        <img src="<?= htmlspecialchars($tour_gallery['gallery2']) ?>" alt="">
                                    </div>
                                    
                                    <!-- 3 -->
                                    <div class="item">
                                        <img src="<?= htmlspecialchars($tour_gallery['gallery3']) ?>" alt="">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- col-form-booking -->
                    <div class="col-xl-4 col-lg-4 col-md-12" id="books">
                        <div class="books-form">
                            <div class="text-head text-center p-4 fw-bold fs-5">ĐẶT TOUR</div>
                
                            <form action="" method="post" enctype="multipart/form-data" class="px-4">
                
                                <label for="stratDate" class="form-label pt-3 pb-0 mb-0 fw-bold">Ngày Bắt Đầu :</label>
                                <div class="input-group pt-1">
                                    <span class="input-group-text border-0 rounded-0"><i class="fa-regular fa-calendar-days border-0"></i></span>
                                    <input type="date" class="input form-control bg-opacity-50 rounded-0" id="startDate" name="startDate" value="<?= htmlspecialchars($tour_inforDetail['startDate'])?>" required>
                                </div>
                
                                <label for="endDate" class="form-label pt-3 pb-0 mb-0 fw-bold">Ngày Kết Thúc :</label>
                                <div class="input-group pt-1">
                                    <span class="input-group-text border-0 rounded-0"><i class="fa-regular fa-calendar-days border-0"></i></span>
                                    <input type="date" class="input form-control bg-opacity-50 rounded-0" id="endDate" name="endDate" value="<?= htmlspecialchars($tour_inforDetail['endDate'])?>" required>
                                </div>
                
                                <label for="roomNumber" class="form-label pt-3 pb-0 mb-0 fw-bold">Số Người :</label>
                                <div class="input-group pt-1">
                                    <span class="input-group-text border-0 rounded-0"><i class="fa-solid fa-door-open border-0"></i></span>
                                    <input type="number" class="form-control text-center" id="roomNumber" name="roomNumber" value="1" min="1">
                                </div>
                                
                                <div class="price pe-0">
                                    <label for="price" class="form-label pt-3 pb-0 mb-0 fw-bold">Giá TOUR :</label>
                                    <div class="input-group pt-1">
                                        <span class="input-group-text border-0 rounded-0"><i class="fa-solid fa-door-open border-0"></i></span>
                                        <input type="text" class="input form-control rounded-0" id="price" name="price" value="<?= number_format(htmlspecialchars($tour_inforDetail['price']), 0, ',', '.') ?> VND" disabled>
                                    </div>
                                </div>
                                
                                <div class="comment pt-4">
                                    <textarea class="form-control rounded-0" id="comment" name="comment" rows="4" placeholder="Nhập ghi chú ở đây..."></textarea>
                                </div>
                                
                                <div class="btn-books w-100 pt-4 text-center">
                                    <button type="submit" name="bookings" class="btn w-100">ĐẶT NGAY</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    
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

    <script src="/Tour_management/asset/js/bootstrap.bundle.min.js"></script>
</body>
</html>
