<section style="background: white" class="pb-3">
    <div class="container-lg">
        <?php
        $listTours =  [(object)
        [
            'code' => '1',
            'name' => 'ĐÔNG BẮC 5N4Đ | HÀ NỘI – HÀ GIANG – CAO BẰNG – BẮC KẠN',
            'image' => '/Tour_management/asset/images/tours/cot-co-lung-cu-ha-giang.png',
            'duration' => '5N4Đ',
            'start_point' => 'TP Hồ Chí Minh',
            'price' => '6990000'
        ],
            (object)[
                'code' => '2',
                'name' => 'MIỀN TRUNG 3N2Đ | ĐÀ NẴNG – CÙ LAO CHÀM – HỘI AN – BÀ NÀ',
                'image' => '/Tour_management/asset/images/tours/cau-vang-da-nang.png',
                'duration' => '3N2Đ',
                'start_point' => 'TP Hồ Chí Minh',
                'price' => '3200000'
            ],
            (object)[
                'code' => '4',
                'name' => 'BIỂN ĐẢO 4N3Đ | PHÚ QUỐC',
                'image' => '/Tour_management/asset/images/tours/biendao_phuquoc.jpg',
                'duration' => '4N3Đ',
                'start_point' => 'TP Hồ Chí Minh',
                'price' => '4690000'
            ],
            (object)[
                'code' => '5',
                'name' => 'KHÁM PHÁ CÔN ĐẢO HUYỀN BÍ',
                'image' => '/Tour_management/asset/images/tours/chua-nui-mot-con-dao.jpg',
                'duration' => '2N1Đ',
                'start_point' => 'TP Hồ Chí Minh',
                'price' => '3490000'
            ],
            (object)[
                'code' => '6',
                'name' => 'MIỀN BẮC 4N3Đ | HÀ NỘI – NINH BÌNH – HẠ LONG – YÊN TỬ',
                'image' => '/Tour_management/asset/images/tours/ninh-binh.png',
                'duration' => '6N5Đ',
                'start_point' => 'TP Hồ Chí Minh',
                'price' => '7690000'
            ],
        ];
        ?>

        <div class="row">
            <div class="col-3">
                <?php
                    include 'modules/home/filter.php';
                ?>
            </div>
            <div class="col-9">
                <div class="row">
                    <?php
                    foreach ($listTours as $tour){
                        ?>
                        <div class="col-4 mt-2">
                            <div class="card tour">
                                <div class="card-tour-img">
                                    <img src="<?php echo $tour->image ?>" alt="<?php echo $tour->name ?>">
                                </div>
                                <div class="card-body">
                                    <p class="duration">Thời lượng: <?php echo $tour->duration ?></p>
                                    <h5 class="card-title" title="<?php echo $tour->name ?>"><?php echo $tour->name ?></h5>
                                    <p class="card-text">Mã tour: <?php echo $tour->code ?></p>
                                    <p class="card-text">Điểm đi: <?php echo $tour->start_point ?></p>
                                    <p class="price">
                                        <i class="fa fa-tag me-2"></i>
                                        <?php
                                        echo number_format($tour->price, 0, ',', '.') . ' VND';
                                        ?>
                                    </p>
                                    <div class="text-end">
                                        <a href="modules/home/tour_detail.php?code=<?php echo $tour->code; ?>" class="btn btn-primary btn-detail">Xem chi tiết</a>
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
