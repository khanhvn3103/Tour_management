<div class="row">
    <div class="col-6">
        <h2 class="text-primary fw-bold mb-4">Quản Lý Tour</h2>
    </div>

    <div class="col-6 text-end">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-primary" href="/Tour_management/modules/tour_manager/index.php?a=create">
                <i class="fa-solid fa-circle-plus"></i>
                Thêm Tour
            </a>

            <button type="button" class="btn btn-primary">
                <i class="fa fa-trash"></i>
                Xóa
            </button>
        </div>
    </div>
</div>

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

<table class="table" id="managerHomeTable">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Mã Tour</th>
        <th scope="col">Tên Tour</th>
        <th scope="col">Thời lượng</th>
        <th scope="col">Điểm xuất phát</th>
        <th scope="col">Giá</th>
        <th class="text-center">Hành động</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($listTours as $item): ?>
        <tr>
            <td>  <input class="form-check-input" type="checkbox" value=""></td>
            <td><?php echo $item->code; ?></td>
            <td><?php echo $item->name ?></td>
            <td><?php echo $item->duration; ?></td>
            <td><?php echo $item->start_point; ?></td>
            <td><?php
                echo number_format($item->price, 0, ',', '.') . ' VND';
                ?></td>
            <td class="text-center">
                <a href="/Tour_management/modules/tour_manager/index.php?a=edit&id=<?php echo $service['id_dich_vu']; ?>" class="btn btn-warning">Sửa</a>
                <button type="button" class="btn btn-danger" onclick="confirmDelete(<?php echo $service['id_dich_vu']; ?>)">Xóa</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
