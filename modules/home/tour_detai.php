
<?php
// Get the tour code from the URL
$tourCode = isset($_GET['code']) ? $_GET['code'] : '';

// List of tours (you can replace this with a database query)
$listTours = [
    (object)[
        'code' => '1',
        'name' => 'ĐÔNG BẮC 5N4Đ | HÀ NỘI – HÀ GIANG – CAO BẰNG – BẮC KẠN',
        'image' => '/Tour_management/asset/images/tours/cot-co-lung-cu-ha-giang.png',
        'duration' => '5N4Đ',
        'start_point' => 'TP Hồ Chí Minh',
        'price' => 6990000,
        'description' => 'Khám phá vẻ đẹp của Đông Bắc với Hà Giang, Cao Bằng và Bắc Kạn.',
        'images' => [
            '/Tour_management/asset/images/tours/ha-giang.png',
            '/Tour_management/asset/images/tours/ha-giang-2.png',
            '/Tour_management/asset/images/tours/ha-giang-3.png',
        ],
        'detailed_description' => '<div class="tour-description">
    <h3>Mô Tả Chi Tiết Tour Du Lịch</h3>
    <p><strong>Tour Du Lịch Đông Bắc 5N4Đ</strong> mang đến cho bạn cơ hội khám phá vẻ đẹp thiên nhiên hùng vĩ và nền văn hóa đặc sắc của các vùng miền phía Bắc Việt Nam.</p>

    <h4>Ngày 1: Hà Nội – Hà Giang</h4>
    <ul>
        <li><strong>Sáng:</strong> Khởi hành từ <strong>Hà Nội</strong>, di chuyển bằng xe khách đến <strong>Hà Giang</strong>.</li>
        <li><strong>Trưa:</strong> Dừng chân tại <strong>Tuyên Quang</strong> để thưởng thức bữa trưa.</li>
        <li><strong>Chiều:</strong> Tiếp tục hành trình đến <strong>Hà Giang</strong>.</li>
    </ul>

    <h4>Ngày 2: Hà Giang – Đồng Văn</h4>
    <ul>
        <li><strong>Sáng:</strong> Khởi hành đi <strong>Đồng Văn</strong>, tham quan <strong>Dinh Thự Vua Mèo</strong>.</li>
        <li><strong>Trưa:</strong> Thưởng thức bữa trưa với món ăn đặc sản.</li>
        <li><strong>Chiều:</strong> Khám phá <strong>Cao Nguyên Đá Đồng Văn</strong>.</li>
    </ul>

    <h4>Ngày 3: Đồng Văn – Mèo Vạc – Cao Bằng</h4>
    <ul>
        <li><strong>Sáng:</strong> Khởi hành đến <strong>Mèo Vạc</strong>, tham quan <strong>đèo Mã Pì Lèng</strong>.</li>
        <li><strong>Trưa:</strong> Ăn trưa tại Mèo Vạc.</li>
        <li><strong>Chiều:</strong> Đến <strong>Cao Bằng</strong>, tham quan <strong>Thác Bản Giốc</strong>.</li>
    </ul>

    <h4>Ngày 4: Cao Bằng – Bắc Kạn</h4>
    <ul>
        <li><strong>Sáng:</strong> Khám phá <strong>Động Ngườm Ngao</strong>.</li>
        <li><strong>Trưa:</strong> Bữa trưa tại Bắc Kạn.</li>
        <li><strong>Chiều:</strong> Tham quan <strong>Hồ Ba Bể</strong>.</li>
    </ul>

    <h4>Ngày 5: Bắc Kạn – Hà Nội</h4>
    <ul>
        <li><strong>Sáng:</strong> Tham quan <strong>vườn quốc gia Ba Bể</strong>.</li>
        <li><strong>Trưa:</strong> Dừng chân ăn trưa trên đường trở về.</li>
        <li><strong>Chiều:</strong> Về đến Hà Nội, kết thúc tour.</li>
    </ul>

    <h4>Lưu Ý</h4>
    <ul>
        <li><strong>Giá Tour:</strong> 6.990.000 VNĐ/người.</li>
        <li><strong>Đối Tượng:</strong> Phù hợp cho những ai yêu thích khám phá.</li>
        <li><strong>Liên Hệ:</strong> Để biết thêm chi tiết, vui lòng liên hệ <strong>1900 6240</strong>.</li>
    </ul>

    <p>Hãy tham gia tour "ĐÔNG BẮC 5N4Đ" để trải nghiệm những điều tuyệt vời!</p>
</div>
'
    ],
    (object)[
        'code' => '2',
        'name' => 'MIỀN TRUNG 3N2Đ | ĐÀ NẴNG – CÙ LAO CHÀM – HỘI AN – BÀ NÀ',
        'image' => '/Tour_management/asset/images/tours/cau-vang-da-nang.png',
        'duration' => '3N2Đ',
        'start_point' => 'TP Hồ Chí Minh',
        'price' => '3200000',
        'description' => 'Khám phá vẻ đẹp của Đông Bắc với Hà Giang, Cao Bằng và Bắc Kạn.',
        'images' => [
            '/Tour_management/asset/images/tours/.png',
            '/Tour_management/asset/images/tours/ha-giang-2.png',
            '/Tour_management/asset/images/tours/ha-giang-3.png',
        ],
        'detailed_description' => '<div class="tour-description">
    <h3>Mô Tả Chi Tiết Tour Du Lịch</h3>
    <p><strong>Tour Du Lịch Miền Trung 3N2Đ</strong> là hành trình tuyệt vời đưa bạn khám phá những vẻ đẹp quyến rũ của miền trung Việt Nam. Trong suốt 3 ngày 2 đêm, bạn sẽ có cơ hội trải nghiệm những hoạt động thú vị và thưởng thức ẩm thực đặc trưng của khu vực này.</p>
    
    <h4>Ngày 1: Đà Nẵng – Cù Lao Chàm</h4>
    <ul>
        <li><strong>Sáng:</strong> Đoàn khởi hành từ Đà Nẵng, di chuyển bằng ca nô đến <strong>Cù Lao Chàm</strong>.</li>
        <li><strong>Trưa:</strong> Thưởng thức bữa trưa với các món hải sản tươi ngon.</li>
        <li><strong>Chiều:</strong> Tự do tham gia các hoạt động như lặn ngắm san hô, câu cá.</li>
    </ul>

    <h4>Ngày 2: Hội An – Khám Phá Phố Cổ</h4>
    <ul>
        <li><strong>Sáng:</strong> Rời Cù Lao Chàm, đoàn di chuyển đến <strong>Hội An</strong>.</li>
        <li><strong>Trưa:</strong> Thưởng thức bữa trưa tại một quán ăn địa phương.</li>
        <li><strong>Chiều:</strong> Tự do khám phá phố cổ, tham gia các hoạt động như làm đèn lồng.</li>
    </ul>

    <h4>Ngày 3: Bà Nà Hills – Đà Nẵng</h4>
    <ul>
        <li><strong>Sáng:</strong> Khởi hành đến <strong>Bà Nà Hills</strong>.</li>
        <li><strong>Trưa:</strong> Thưởng thức buffet tại nhà hàng trên Bà Nà.</li>
        <li><strong>Chiều:</strong> Tham quan Chùa Linh Ứng và Vườn Hoa trước khi trở về Đà Nẵng.</li>
    </ul>

    <h4>Lưu Ý</h4>
    <ul>
        <li><strong>Giá Tour:</strong> 3.200.000 VNĐ/người.</li>
        <li><strong>Đối Tượng:</strong> Phù hợp cho mọi lứa tuổi.</li>
        <li><strong>Liên Hệ:</strong> Để biết thêm chi tiết và đặt tour, vui lòng liên hệ <strong>1900 6420</strong>.</li>
    </ul>

    <p>Hãy tham gia tour "MIỀN TRUNG 3N2Đ" để có những trải nghiệm tuyệt vời!</p>
</div>
'
    ],
    (object)[
        'code' => '4',
        'name' => 'BIỂN ĐẢO 4N3Đ | PHÚ QUỐC',
        'image' => '/Tour_management/asset/images/tours/biendao_phuquoc.jpg',
        'duration' => '4N3Đ',
        'start_point' => 'TP Hồ Chí Minh',
        'price' => '4690000',
        'description' => 'Khám phá vẻ đẹp của Đông Bắc với Hà Giang, Cao Bằng và Bắc Kạn.',
        'images' => [
            '/Tour_management/asset/images/tours/ha-giang-1.png',
            '/Tour_management/asset/images/tours/ha-giang-2.png',
            '/Tour_management/asset/images/tours/ha-giang-3.png',
        ],
        'detailed_description' => '<div class="tour-description">
        <h3>Mô Tả Chi Tiết Tour Du Lịch "BIỂN ĐẢO 4N3Đ | PHÚ QUỐC"</h3>
        
        <p><strong>Tour Du Lịch "BIỂN ĐẢO 4N3Đ"</strong> là một hành trình thú vị đưa bạn đến khám phá vẻ đẹp thiên nhiên tuyệt vời và nền văn hóa phong phú của <strong>Đảo Phú Quốc</strong>. Trong suốt 4 ngày 3 đêm, bạn sẽ có cơ hội trải nghiệm những hoạt động thú vị và thưởng thức ẩm thực đặc sản nơi đây.</p>
        
        <h4>Ngày 1: <strong>Khởi Hành Từ TP Hồ Chí Minh – Đến Phú Quốc</strong></h4>
        <ul>
            <li><strong>Sáng:</strong> Khởi hành từ <strong>TP Hồ Chí Minh</strong> bằng máy bay, bay thẳng đến <strong>Sân bay Quốc tế Phú Quốc</strong>.</li>
            <li><strong>Trưa:</strong> Đến nơi, đoàn di chuyển về khách sạn nhận phòng và nghỉ ngơi.</li>
            <li><strong>Chiều:</strong> Tham quan <strong>Bãi Dài</strong>, một trong những bãi biển đẹp nhất Phú Quốc.</li>
            <li><strong>Tối:</strong> Tham gia chương trình thưởng thức hải sản tại <strong>chợ đêm Dinh Cậu</strong>.</li>
        </ul>

        <h4>Ngày 2: <strong>Khám Phá Đảo Phú Quốc</strong></h4>
        <ul>
            <li><strong>Sáng:</strong> Khởi hành đi <strong>Vinpearl Safari</strong>, tham quan vườn thú lớn nhất Việt Nam.</li>
            <li><strong>Trưa:</strong> Ăn trưa tại nhà hàng trong khuôn viên Vinpearl.</li>
            <li><strong>Chiều:</strong> Tham quan <strong>Khu vui chơi giải trí VinWonders</strong>.</li>
            <li><strong>Tối:</strong> Quý khách tự do khám phá Phú Quốc về đêm.</li>
        </ul>

        <h4>Ngày 3: <strong>Tham Quan Các Hòn Đảo Xung Quanh</strong></h4>
        <ul>
            <li><strong>Sáng:</strong> Đi tour tham quan các hòn đảo nhỏ như <strong>Hòn Móng Tay</strong>, <strong>Hòn Gầm Ghì</strong> bằng cano.</li>
            <li><strong>Trưa:</strong> Thưởng thức bữa trưa với món <strong>hải sản nướng</strong>.</li>
            <li><strong>Chiều:</strong> Tiếp tục tham quan <strong>Hòn Một</strong>.</li>
            <li><strong>Tối:</strong> Quý khách về khách sạn, nghỉ ngơi và thưởng thức bữa tối tại nhà hàng.</li>
        </ul>

        <h4>Ngày 4: <strong>Khám Phá Đặc Sản và Trở Về</strong></h4>
        <ul>
            <li><strong>Sáng:</strong> Tham quan <strong>Nhà thùng sản xuất nước mắm Phú Quốc</strong>.</li>
            <li><strong>Trưa:</strong> Dùng bữa tại nhà hàng, thưởng thức các món ăn đặc sản.</li>
            <li><strong>Chiều:</strong> Tự do mua sắm và khám phá <strong>chợ Dương Đông</strong> trước khi ra sân bay.</li>
            <li><strong>Tối:</strong> Lên chuyến bay trở về <strong>TP Hồ Chí Minh</strong>.</li>
        </ul>

        <h4><strong>Lưu Ý</strong></h4>
        <ul>
            <li><strong>Giá Tour:</strong> 4.690.000 VNĐ/người.</li>
            <li><strong>Đối Tượng:</strong> Phù hợp cho mọi lứa tuổi.</li>
            <li><strong>Liên Hệ:</strong> Để biết thêm chi tiết và đặt tour, vui lòng liên hệ <strong>1900 6420</strong>.</li>
        </ul>

        <p>Hãy tham gia tour "BIỂN ĐẢO 4N3Đ" để trải nghiệm những điều tuyệt vời tại <strong>Phú Quốc</strong>!</p>
    </div>'
    ],
    (object)[
        'code' => '5',
        'name' => 'KHÁM PHÁ CÔN ĐẢO HUYỀN BÍ',
        'image' => '/Tour_management/asset/images/tours/chua-nui-mot-con-dao.jpg',
        'duration' => '2N1Đ',
        'start_point' => 'TP Hồ Chí Minh',
        'price' => '3490000',
        'description' => 'Khám phá vẻ đẹp của Đông Bắc với Hà Giang, Cao Bằng và Bắc Kạn.',
        'images' => [
            '/Tour_management/asset/images/tours/ha-giang-1.png',
            '/Tour_management/asset/images/tours/ha-giang-2.png',
            '/Tour_management/asset/images/tours/ha-giang-3.png',
        ],
        'detailed_description' => '<div class="tour-description">
        <h3>Mô Tả Chi Tiết Tour Du Lịch "KHÁM PHÁ CÔN ĐẢO HUYỀN BÍ"</h3>
        
        <p>Chào mừng bạn đến với tour du lịch <strong>"KHÁM PHÁ CÔN ĐẢO HUYỀN BÍ"</strong>, nơi bạn sẽ được trải nghiệm những vẻ đẹp tự nhiên tuyệt vời và tìm hiểu về lịch sử đầy bi tráng của vùng đất này. Trong hành trình 4 ngày 3 đêm, bạn sẽ được khám phá các bãi biển hoang sơ, tham gia các hoạt động thú vị và thưởng thức các món ăn đặc sản.</p>
        
        <h4>Ngày 1: <strong>Khởi Hành Từ TP Hồ Chí Minh – Đến Côn Đảo</strong></h4>
        <ul>
            <li><strong>Sáng:</strong> Khởi hành từ <strong>TP Hồ Chí Minh</strong> bằng máy bay, bay thẳng đến <strong>Sân bay Côn Đảo</strong>.</li>
            <li><strong>Trưa:</strong> Đến nơi, xe đưa đoàn về khách sạn nhận phòng và nghỉ ngơi.</li>
            <li><strong>Chiều:</strong> Tham quan <strong>Thị trấn Côn Đảo</strong> và <strong>Bãi Nhát</strong>, nơi có bãi biển đẹp và yên tĩnh.</li>
            <li><strong>Tối:</strong> Dùng bữa tối tại nhà hàng với các món ăn hải sản tươi ngon.</li>
        </ul>

        <h4>Ngày 2: <strong>Khám Phá Các Di Tích Lịch Sử</strong></h4>
        <ul>
            <li><strong>Sáng:</strong> Tham quan <strong>Nhà tù Côn Đảo</strong> để tìm hiểu về lịch sử đau thương của đất nước.</li>
            <li><strong>Trưa:</strong> Dùng bữa tại nhà hàng địa phương.</li>
            <li><strong>Chiều:</strong> Tiếp tục tham quan <strong>Đền thờ Nguyễn Huệ</strong> và <strong>Chùa Núi Một</strong>.</li>
            <li><strong>Tối:</strong> Quý khách tự do khám phá Côn Đảo về đêm.</li>
        </ul>

        <h4>Ngày 3: <strong>Tham Quan Các Hòn Đảo Xung Quanh</strong></h4>
        <ul>
            <li><strong>Sáng:</strong> Khởi hành đi tham quan <strong>Hòn Bảy Cạnh</strong> bằng thuyền, nơi có rừng ngập mặn và động vật hoang dã phong phú.</li>
            <li><strong>Trưa:</strong> Dùng bữa trưa tại nhà hàng trên đảo.</li>
            <li><strong>Chiều:</strong> Tắm biển và tham gia các hoạt động thể thao dưới nước như lặn biển và câu cá.</li>
            <li><strong>Tối:</strong> Trở về Côn Đảo và dùng bữa tối tại nhà hàng.</li>
        </ul>

        <h4>Ngày 4: <strong>Khám Phá Đặc Sản và Trở Về</strong></h4>
        <ul>
            <li><strong>Sáng:</strong> Tham quan <strong>Chợ Côn Đảo</strong> và mua sắm đặc sản địa phương như mứt và hải sản khô.</li>
            <li><strong>Trưa:</strong> Dùng bữa tại nhà hàng với món ăn truyền thống.</li>
            <li><strong>Chiều:</strong> Tự do khám phá và chuẩn bị ra sân bay trở về <strong>TP Hồ Chí Minh</strong>.</li>
            <li><strong>Tối:</strong> Lên chuyến bay trở về, kết thúc tour.</li>
        </ul>

        <h4><strong>Lưu Ý</strong></h4>
        <ul>
            <li><strong>Giá Tour:</strong> 5.690.000 VNĐ/người.</li>
            <li><strong>Đối Tượng:</strong> Phù hợp cho mọi lứa tuổi.</li>
            <li><strong>Liên Hệ:</strong> Để biết thêm chi tiết và đặt tour, vui lòng liên hệ <strong>1900 6420</strong>.</li>
        </ul>

        <p>Hãy tham gia tour "KHÁM PHÁ CÔN ĐẢO HUYỀN BÍ" để trải nghiệm những điều kỳ diệu tại <strong>Côn Đảo</strong>!</p>
    </div>'
    ],
    (object)[
        'code' => '6',
        'name' => 'MIỀN BẮC 4N3Đ | HÀ NỘI – NINH BÌNH – HẠ LONG – YÊN TỬ',
        'image' => '/Tour_management/asset/images/tours/ninh-binh.png',
        'duration' => '6N5Đ',
        'start_point' => 'TP Hồ Chí Minh',
        'price' => '7690000',
        'description' => 'Khám phá vẻ đẹp của Đông Bắc với Hà Giang, Cao Bằng và Bắc Kạn.',
        'images' => [
            '/Tour_management/asset/images/tours/ha-giang-1.png',
            '/Tour_management/asset/images/tours/ha-giang-2.png',
            '/Tour_management/asset/images/tours/ha-giang-3.png',
        ],
        'detailed_description' => '<div class="tour-description">
        <h3>Mô Tả Chi Tiết Tour Du Lịch "MIỀN BẮC 4N3Đ"</h3>
        
        <p>Chào mừng bạn đến với tour du lịch <strong>"MIỀN BẮC 4N3Đ"</strong>, nơi bạn sẽ được khám phá những cảnh đẹp nổi tiếng và di sản văn hóa của miền Bắc Việt Nam. Hành trình kéo dài 4 ngày 3 đêm, đưa bạn đến những điểm đến hấp dẫn như <strong>Hà Nội</strong>, <strong>Ninh Bình</strong>, <strong>Hạ Long</strong> và <strong>Yên Tử</strong>.</p>
        
        <h4>Ngày 1: <strong>Khởi Hành Từ TP Hồ Chí Minh – Đến Hà Nội</strong></h4>
        <ul>
            <li><strong>Sáng:</strong> Khởi hành từ <strong>TP Hồ Chí Minh</strong> và đáp chuyến bay tới <strong>Hà Nội</strong>.</li>
            <li><strong>Trưa:</strong> Đến Hà Nội, xe đưa bạn về khách sạn nhận phòng và nghỉ ngơi.</li>
            <li><strong>Chiều:</strong> Tham quan <strong>Hoàn Kiếm</strong>, <strong>Đền Ngọc Sơn</strong> và đi dạo phố cổ Hà Nội.</li>
            <li><strong>Tối:</strong> Dùng bữa tối tại nhà hàng với các món ăn đặc sản Hà Nội.</li>
        </ul>

        <h4>Ngày 2: <strong>Khám Phá Ninh Bình</strong></h4>
        <ul>
            <li><strong>Sáng:</strong> Khởi hành đi <strong>Ninh Bình</strong>, tham quan <strong>Tràng An</strong> và <strong>Hang Múa</strong>.</li>
            <li><strong>Trưa:</strong> Dùng bữa tại nhà hàng địa phương với các món ăn truyền thống.</li>
            <li><strong>Chiều:</strong> Tham quan <strong>Chùa Bái Đính</strong>, một trong những chùa lớn nhất Việt Nam.</li>
            <li><strong>Tối:</strong> Trở về Hà Nội và tự do khám phá phố phường về đêm.</li>
        </ul>

        <h4>Ngày 3: <strong>Hạ Long – Kỳ Quan Thiên Nhiên</strong></h4>
        <ul>
            <li><strong>Sáng:</strong> Khởi hành đi <strong>Vịnh Hạ Long</strong>, tham quan những đảo đá và hang động nổi tiếng.</li>
            <li><strong>Trưa:</strong> Dùng bữa trưa trên tàu, thưởng thức hải sản tươi ngon.</li>
            <li><strong>Chiều:</strong> Tham gia các hoạt động như kayaking và tắm biển.</li>
            <li><strong>Tối:</strong> Trở về Hà Nội, dùng bữa tối tại nhà hàng.</li>
        </ul>

        <h4>Ngày 4: <strong>Tham Quan Yên Tử và Trở Về</strong></h4>
        <ul>
            <li><strong>Sáng:</strong> Khởi hành đi <strong>Yên Tử</strong>, tham quan <strong>Chùa Hoa Yên</strong> và <strong>Chùa Đồng</strong>.</li>
            <li><strong>Trưa:</strong> Dùng bữa tại nhà hàng địa phương.</li>
            <li><strong>Chiều:</strong> Quay về Hà Nội, tự do tham quan và mua sắm.</li>
            <li><strong>Tối:</strong> Lên chuyến bay trở về <strong>TP Hồ Chí Minh</strong>, kết thúc tour.</li>
        </ul>

        <h4><strong>Lưu Ý</strong></h4>
        <ul>
            <li><strong>Giá Tour:</strong> 7.990.000 VNĐ/người.</li>
            <li><strong>Đối Tượng:</strong> Phù hợp cho mọi lứa tuổi.</li>
            <li><strong>Liên Hệ:</strong> Để biết thêm chi tiết và đặt tour, vui lòng liên hệ <strong>1900 6420</strong>.</li>
        </ul>

        <p>Hãy tham gia tour "MIỀN BẮC 4N3Đ" để khám phá những điều kỳ diệu tại <strong>miền Bắc Việt Nam</strong>!</p>
    </div>'
    ],
];

// Find the selected tour based on the code
$selectedTour = null;
foreach ($listTours as $tour) {
    if ($tour->code == $tourCode) {
        $selectedTour = $tour;
        break;
    }
}

// If tour not found, show error
if (!$selectedTour) {
    echo "<h1>Tour không tồn tại!</h1>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $selectedTour->name; ?></title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Tour_management/asset/css/style.css">
</head>
<body>
<section class="tour-detail pb-5">
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-6">
                    <!-- Main Tour Image -->
                    <img src="<?php echo $selectedTour->image; ?>" class="img-fluid mb-3" alt="<?php echo $selectedTour->name; ?>">
                    
                    <!-- Image Carousel -->
                    <div id="tourCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($selectedTour->images as $index => $img) { ?>
                                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                    <img src="<?php echo $img; ?>" class="d-block w-100" alt="Tour Image <?php echo $index + 1; ?>">
                                </div>
                            <?php } ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#tourCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#tourCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <div class="col-md-6">
                    <h1><?php echo $selectedTour->name; ?></h1>
                    <p><strong>Thời lượng:</strong> <?php echo $selectedTour->duration; ?></p>
                    <p><strong>Điểm khởi hành:</strong> <?php echo $selectedTour->start_point; ?></p>
                    <p><strong>Giá:</strong> <?php echo number_format($selectedTour->price, 0, ',', '.'); ?> VND</p>
                    <p><?php echo $selectedTour->description; ?></p>

                    <form action="booking.php" method="POST">
                        <input type="hidden" name="tour_code" value="<?php echo $selectedTour->code; ?>">
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
    
                    <p><?php echo nl2br($selectedTour->detailed_description); ?></p>
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
