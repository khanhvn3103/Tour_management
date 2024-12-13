<?php
$db = new modelSpot();
$data = $db->selectAllSpots();
?>

<div class="row">
    <div class="col-6">
        <h2 class="text-primary fw-bold mb-4">Quản Lý Địa Điểm Du Lịch</h2>
    </div>

    <div class="col-6 text-end">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-primary" href="/Tour_management/modules/sightseeing_spot/index.php?a=create">
                <i class="fa-solid fa-circle-plus"></i>
                Thêm Địa Điểm
            </a>
            <button type="button" class="btn btn-primary" onclick="confirmDeleteSelected()">
                <i class="fa fa-trash"></i>
                Xóa
            </button>
        </div>
    </div>
</div>

<table class="table" id="spotManagerTable">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Mã Địa Điểm</th>
        <th scope="col">Hình ảnh</th>
        <th scope="col">Tên Địa Điểm</th>
        <th scope="col">Thời Gian Bắt Đầu</th>
        <th scope="col">Thời Gian Kết Thúc</th>
        <th scope="col">Mô Tả</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $item): ?>
        <tr>
            <td><input class="form-check-input" type="checkbox" value="<?php echo $item['spotCode']; ?>" name="selected_ids[]"></td>
            <td><?php echo $item['spotCode']; ?></td>
            <td><img style="border-radius: 6px" src="<?php echo $item['image'] ? `/Tour_management/modules/sightseeing_spot/` . $item['image'] : '/Tour_management/asset/images/default-thumbnail.jpg'; ?>" alt="<?php echo $item['spotName']; ?>" width="100px"/></td>
            <td><a href="/Tour_management/modules/sightseeing_spot/index.php?a=edit&id=<?php echo $item['spotCode']; ?>" class="text-decoration-none"><?php echo $item['spotName']; ?></a></td>
            <td><?php echo $item['startTime']; ?></td>
            <td><?php echo $item['endTime']; ?></td>
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
                text: "Vui lòng chọn ít nhất một địa điểm để xóa.",
                focusConfirm: true,
                confirmButtonText: "OK",
            });
            return;
        }Swal.fire({
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
                window.location.href = "/Tour_management/modules/sightseeing_spot/index.php?a=delete&ids=" + ids;
            }
        });

    }
</script>
