<?php
$db = new modelTour();
$data = $db->selectAllTours();
?>

<div class="row">
    <div class="col-6">
        <h2 class="text-primary fw-bold mb-4">Quản Lý Tour</h2>
    </div>

    <div class="col-6 text-end">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-primary" href="/Tour_management/modules/tour_manage/index.php?a=create">
                <i class="fa-solid fa-circle-plus"></i>
                Thêm Tour
            </a>
            <button type="button" class="btn btn-primary" onclick="confirmDeleteSelected()">
                <i class="fa fa-trash"></i>
                Xóa
            </button>
        </div>
    </div>
</div>

<table class="table" id="tourManagerTable">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Mã Tour</th>
        <th scope="col">Tên Tour</th>
        <th scope="col">Ngày Bắt Đầu</th>
        <th scope="col">Ngày Kết Thúc</th>
        <th scope="col">Giá</th>
        <th scope="col">Mô Tả</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $item): ?>
        <tr>
            <td><input class="form-check-input" type="checkbox" value="<?php echo $item['tourCode']; ?>" name="selected_ids[]"></td>
            <td><?php echo $item['tourCode']; ?></td>
            <td><a href="/Tour_management/modules/tour_manage/index.php?a=edit&id=<?php echo $item['tourCode']; ?>" class="text-decoration-none fw-bold"><?php echo $item['tourName']; ?></a></td>
            <td><?php echo $item['startDate']; ?></td>
            <td><?php echo $item['endDate']; ?></td>
            <td><?php echo $item['price']; ?></td>
            <td><?php echo $item['description']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    function confirmDeleteSelected() {
        const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]:checked');
        if (checkboxes.length === 0) {
            Swal.fire({
                icon: "info",
                text: "Vui lòng chọn ít nhất một tour để xóa.",
                focusConfirm: true,
                confirmButtonText: "OK",
            });
            return;
        }
        Swal.fire({
            icon: "question",
            text: "Bạn có chắc chắn muốn xóa các gói tour đã chọn?",
            focusConfirm: true,
            showCancelButton: true,
            confirmButtonText: "OK",
            CancelButtonText: `Hủy`
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Xóa thành công!", "", "success");
                const ids = Array.from(checkboxes).map(cb => cb.value).join(',');
                window.location.href = "/Tour_management/modules/tour/index.php?a=delete&ids=" + ids;
            }
        });
    }
</script>
