<section style="background: white">
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
                'duration' => '5N4Đ',
                'start_point' => 'TP Hồ Chí Minh',
                'price' => '6990000'
            ],
            (object)[
                'code' => '3',
                'name' => 'MIỀN TRUNG 3N2Đ | ĐÀ NẴNG – HỘI AN – RỪNG DỪA BẢY MẪU – BÀ NÀ',
                'image' => '/Tour_management/asset/images/tours/ba-na-hill-tu-tren-cao.png',
                'duration' => '5N4Đ',
                'start_point' => 'TP Hồ Chí Minh',
                'price' => '6990000'
            ],
            (object)[
                'code' => '4',
                'name' => 'BIỂN ĐẢO 4N3Đ | PHÚ QUỐC',
                'image' => '/Tour_management/asset/images/tours/biendao_phuquoc.jpg',
                'duration' => '5N4Đ',
                'start_point' => 'TP Hồ Chí Minh',
                'price' => '6990000'
            ],
            (object)[
                'code' => '5',
                'name' => 'KHÁM PHÁ CÔN ĐẢO HUYỀN BÍ',
                'image' => '/Tour_management/asset/images/tours/chua-nui-mot-con-dao.jpg',
                'duration' => '5N4Đ',
                'start_point' => 'TP Hồ Chí Minh',
                'price' => '6990000'
            ],
            (object)[
                'code' => '6',
                'name' => 'MIỀN BẮC 4N3Đ | HÀ NỘI – NINH BÌNH – HẠ LONG – YÊN TỬ',
                'image' => '/Tour_management/asset/images/tours/ninh-binh.png',
                'duration' => '5N4Đ',
                'start_point' => 'TP Hồ Chí Minh',
                'price' => '6990000'
            ],
        ];
        ?>

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
                            <p class="duration">Duration: <?php echo $tour->duration ?></p>
                            <h5 class="card-title" title="<?php echo $tour->name ?>"><?php echo $tour->name ?></h5>
                            <p class="card-text">Tour code: <?php echo $tour->code ?></p>
                            <p class="card-text">Start point: <?php echo $tour->start_point ?></p>
                            <p class="price">
                                <i class="fa fa-tag me-2"></i>
                                <?php
                                echo number_format($tour->price, 0, ',', '.') . ' VND';
                                ?>
                            </p>
                            <div class="text-end">
                                <a href="#">View detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>


    </div>

</section>