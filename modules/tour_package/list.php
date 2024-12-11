<?php
$db = new modelTourPackage();
$data = $db->selectAllTourPackages();
?>

<div class="row">
    <div class="col-6">
        <h2 class="text-primary fw-bold mb-4">Quản Lý Gói Tour</h2>
    </div>

    <div class="col-6 text-end">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-primary" href="/Tour_management/modules/tour_package/index.php?a=create">
                <i class="fa-solid fa-circle-plus"></i>
                Thêm Gói Tour
            </a>

            <button type="button" class="btn btn-primary" onclick="confirmDeleteSelected()">
                <i class="fa fa-trash"></i>
                Xóa
            </button>
        </div>
    </div>
</div>

<table class="table" id="categoryManagerHomeTable">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Mã Gói</th>
        <th scope="col">Hình ảnh</th>
        <th scope="col">Tên Gói</th>
        <th scope="col">Điểm xuất phát</th>
        <th scope="col">Điểm đến</th>
        <th scope="col">Mô tả</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $item): ?>
        <tr>
            <td><input class="form-check-input" type="checkbox" value="<?php echo $item['tourPackageCode']; ?>" name="selected_ids[]"></td>
            <td><img src="<?php echo $item['image'] ? `/Tour_management/modules/tour_package/` . $item['image'] : '/Tour_management/asset/images/default-thumbnail.jpg'; ?>" alt="<?php echo $item['packageName']; ?>" width="100px"/></td>
            <td><?php echo $item['tourPackageCode']; ?></td>
            <td><a href="/Tour_management/modules/tour_package/index.php?a=edit&id=<?php echo $item['tourPackageCode']; ?>" class="text-decoration-none fw-bold"><?php echo $item['packageName']; ?></a></td>
            <td><?php echo $item['startingPoint']; ?></td>
            <td><?php echo $item['endPoint']; ?></td>
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
                text: "Vui lòng chọn ít nhất một gói tour để xóa.",
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
                window.location.href = "/Tour_management/modules/tour_package/index.php?a=delete&ids=" + ids;
            }
        });
    }
</script>
