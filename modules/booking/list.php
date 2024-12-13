<?php

$db = new modelBooking();
$bookings = $db->selectAllBookings();
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

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Tên Khách Hàng</th>
        <th scope="col">Tên Tour</th>
        <th scope="col">Số Người Lớn</th>
        <th scope="col">Số Trẻ Em</th>
        <th scope="col">Ngày Đặt</th>
        <th scope="col">Trạng Thái</th>
        <th scope="col">Hành Động</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($bookings as $index => $booking): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo htmlspecialchars($booking['fullName']); ?></td>
            <td><?php echo htmlspecialchars($booking['tourName']); ?></td>
            <td><?php echo htmlspecialchars($booking['numberOfAdults']); ?></td>
            <td><?php echo htmlspecialchars($booking['numberOfChildren']); ?></td>
            <td><?php echo date('d/m/Y H:i', strtotime($booking['bookingDate'])); ?></td>
            <td><?php echo htmlspecialchars($booking['status'] ? ($booking['status'] == 'approved' ? 'Đã duyệt' : 'Từ chối')  : 'Chờ duyệt'); ?></td>
            <td>
                <form action="approve_booking.php" method="POST" style="display:inline;">
                    <input type="hidden" name="formCode" value="<?php echo $booking['formCode']; ?>">
                    <input type="hidden" name="customerCode" value="<?php echo $booking['customerCode']; ?>">
                    <button type="submit" class="btn btn-success">Duyệt</button>
                </form>
                <form action="reject_booking.php" method="POST" style="display:inline;">
                    <input type="hidden" name="formCode" value="<?php echo $booking['formCode']; ?>">
                    <input type="hidden" name="customerCode" value="<?php echo $booking['customerCode']; ?>">
                    <button type="submit" class="btn btn-danger">Từ Chối</button>
                </form>
            </td>
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
