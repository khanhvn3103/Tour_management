<div class="row">
    <div class="col-6">
        <h2 class="text-primary fw-bold mb-4">Quản Lý Gói Tour</h2>
    </div>

    <div class="col-6 text-end">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-primary" href="/Tour_management/modules/tour_category_management/index.php?a=create">
                <i class="fa-solid fa-circle-plus"></i>
                Thêm Gói Tour
            </a>

            <button type="button" class="btn btn-primary">
                <i class="fa fa-trash"></i>
                Xóa
            </button>

        </div>
    </div>
</div>

<?php
$data = [
    [
        'id' => 1,
        'ma_goi' => 'G001',
        'ten_goi' => 'Gói Du Lịch 1',
        'diem_xuat_phat' => 'Hà Nội',
        'diem_den' => 'Đà Nẵng',
        'mo_ta' => 'Chương trình du lịch 5 ngày 4 đêm.'
    ],
    [
        'id' => 2,
        'ma_goi' => 'G002',
        'ten_goi' => 'Gói Du Lịch 2',
        'diem_xuat_phat' => 'TP. Hồ Chí Minh',
        'diem_den' => 'Phú Quốc',
        'mo_ta' => 'Kỳ nghỉ tuyệt vời tại đảo ngọc.'
    ],
    [
        'id' => 3,
        'ma_goi' => 'G003',
        'ten_goi' => 'Gói Du Lịch 3',
        'diem_xuat_phat' => 'Hà Nội',
        'diem_den' => 'Hạ Long',
        'mo_ta' => 'Khám phá kỳ quan thiên nhiên thế giới.'
    ],
    [
        'id' => 4,
        'ma_goi' => 'G004',
        'ten_goi' => 'Gói Du Lịch 4',
        'diem_xuat_phat' => 'Đà Nẵng',
        'diem_den' => 'Nha Trang',
        'mo_ta' => 'Thư giãn trên bãi biển tuyệt đẹp.'
    ],
    [
        'id' => 5,
        'ma_goi' => 'G005',
        'ten_goi' => 'Gói Du Lịch 5',
        'diem_xuat_phat' => 'Hà Nội',
        'diem_den' => 'Sapa',
        'mo_ta' => 'Khám phá vẻ đẹp của núi rừng Tây Bắc.'
    ],
    [
        'id' => 6,
        'ma_goi' => 'G006',
        'ten_goi' => 'Gói Du Lịch 6',
        'diem_xuat_phat' => 'TP. Hồ Chí Minh',
        'diem_den' => 'Cần Thơ',
        'mo_ta' => 'Trải nghiệm văn hóa miền Tây.'
    ],
    [
        'id' => 7,
        'ma_goi' => 'G007',
        'ten_goi' => 'Gói Du Lịch 7',
        'diem_xuat_phat' => 'Hà Nội',
        'diem_den' => 'Ninh Bình',
        'mo_ta' => 'Khám phá Tràng An và Bái Đính.'
    ],
    [
        'id' => 8,
        'ma_goi' => 'G008',
        'ten_goi' => 'Gói Du Lịch 8',
        'diem_xuat_phat' => 'Đà Nẵng',
        'diem_den' => 'Huế',
        'mo_ta' => 'Chuyến đi về với di sản văn hóa.'
    ],
    [
        'id' => 9,
        'ma_goi' => 'G009',
        'ten_goi' => 'Gói Du Lịch 9',
        'diem_xuat_phat' => 'TP. Hồ Chí Minh',
        'diem_den' => 'Mũi Né',
        'mo_ta' => 'Thư giãn tại bãi biển Mũi Né.'
    ],
    [
        'id' => 10,
        'ma_goi' => 'G010',
        'ten_goi' => 'Gói Du Lịch 10',
        'diem_xuat_phat' => 'Hà Nội',
        'diem_den' => 'Hà Giang',
        'mo_ta' => 'Khám phá vẻ đẹp của cao nguyên đá.'
    ]
];
?>

<table class="table" id="categoryManagerHomeTable">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Mã Gói</th>
        <th scope="col">Tên Gói</th>
        <th scope="col">Điểm xuất phát</th>
        <th scope="col">Điểm đến</th>
        <th scope="col">Mô tả</th>
        <th class="text-center">Hành động</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $item): ?>
        <tr>
            <td>  <input class="form-check-input" type="checkbox" value=""></td>
            <td><?php echo $item['ma_goi']; ?></td>
            <td><?php echo $item['ten_goi']; ?></td>
            <td><?php echo $item['diem_xuat_phat']; ?></td>
            <td><?php echo $item['diem_den']; ?></td>
            <td><?php echo $item['mo_ta']; ?></td>
            <td class="text-center">
                <a href="/Tour_management/modules/tour_category_management/index.php?a=edit&id=<?php echo $service['id_dich_vu']; ?>" class="btn btn-warning">Sửa</a>
                <button type="button" class="btn btn-danger" onclick="confirmDelete(<?php echo $service['id_dich_vu']; ?>)">Xóa</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>