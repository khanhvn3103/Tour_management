<?php

$db = new modelBooking();
$customerCode = 1; // Thay thế bằng mã khách hàng thực tế (có thể lấy từ session)

$notifications = $db->getNotifications($customerCode);
?>

<div class="container" style="margin-top: 150px">
    <h2 class="text-primary fw-bold mb-4">Thông Báo</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nội Dung</th>
            <th scope="col">Thời Gian</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($notifications): ?>
            <?php foreach ($notifications as $index => $notification): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($notification['message']); ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($notification['created_at'])); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center">Không có thông báo nào.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
