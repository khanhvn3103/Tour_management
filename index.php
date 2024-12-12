<?php
    header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', FALSE);
    header('Pragma: no-cache');
    include 'models/tourPackage.php';
    include "models/booking.php";
    if(isset($_GET["m"])){
        $m = $_GET["m"];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache" />
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/Tour_management/asset/css/docs.css"/>
    <link rel="stylesheet" href="/Tour_management/asset/css/all.css" id="theme-styles"/>
    <link rel="stylesheet" href="/Tour_management/asset/css/boostrap_custome.css" id="theme-styles"/>
    <link rel="stylesheet" href="/Tour_management/asset/css/style.css" id="theme-styles"/>
    <link rel="stylesheet" href="/Tour_management/asset/css/user.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Travellowkey</title>
</head>

<body>
<?php
include 'view/header.php';
?>

<div class="content" style="min-height: 72.2vh">
    <?php
    // index.php?m=category&a=delete&id=1
    if (isset($m)) {
        switch ($m) {
            case 'user':
                include 'modules/user/index.php';
                break;
            case 'management':
                include 'modules/management/index.php';
                break;
            case 'notifications':
                include 'modules/home/notifications.php';
                break;
            default:
                include 'modules/home/index.php';
        }
    } else {
        include 'modules/home/index.php';
    }
    ?>
</div>

<footer class="footer bg-body border-top" data-bs-theme="dark">
    <div class="container pb-md-2">
        <div class="row">
            <div class="col-3">
                <img src="asset/images/travellowkey_logo.png" style="width: 200px">
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
</body>
<script src="/Tour_management/asset/js/boostrap.bundle.min.js"></script>
</html>
