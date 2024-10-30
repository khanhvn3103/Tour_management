<?php
    header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', FALSE);
    header('Pragma: no-cache');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Travellowkey</title>
</head>

<body>

<header class="navbar navbar-expand-lg navbar-light bg-light p-2 w-100" id="header">
    <div class="container-lg">
       <div class="d-flex align-content-center">
           <a class="navbar-brand" href="/"> <img src="asset/images/travellowkey_logo.png" class="logo"></a>
           <ul class="navbar-nav">
               <li class="nav-item active dropdown pt-lg-3 pb-lg-2 me-lg-n1 me-xl-0">
                   <a class="nav-link active" aria-current="page" href="#" role="button"
                      data-bs-toggle="dropdown" data-bs-trigger="hover" aria-expanded="false">TRANG CHỦ</a>
               </li>
               <li class="nav-item dropdown pt-lg-3 pb-lg-2 me-lg-n1 me-xl-0">
                   <a class="nav-link" aria-current="page" href="#" role="button"
                      data-bs-toggle="dropdown" data-bs-trigger="hover" aria-expanded="false">THÔNG TIN CỦA TÔI</a>
               </li>
           </ul>
       </div>
      <div>
          <button class="btn btn-secondary me-1">Đăng ký</button>
          <button class="btn btn-primary">Đăng nhập</button>
      </div>
    </div>


<!--    <div class="container-lg">-->
<!--        <button type="button" class="navbar-toggler me-3 me-lg-0" data-bs-toggle="offcanvas"-->
<!--                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">-->
<!--            <span class="navbar-toggler-icon"></span>-->
<!--        </button>-->
<!--        <a class="navbar-brand py-1 py-md-2 py-xl-1 me-2 me-sm-n4 me-md-n5 me-lg-0" href="index.php">-->
<!--            <span class="d-none d-sm-flex flex-shrink-0 text-primary rtl-flip me-2">-->
<!--                <img src="asset/images/travellowkey_logo.png" width="100px">-->
<!--            </span>-->
<!--        </a>-->
<!--        <nav class="offcanvas offcanvas-start" id="header" tabindex="-1" aria-labelledby="navbarNavLabel">-->
<!--            <div class="offcanvas-body pt-2 pb-4 py-lg-0 mx-lg-auto">-->
<!--                <ul class="navbar-nav position-relative">-->
<!--                    <li class="nav-item active dropdown py-lg-2 me-lg-n1 me-xl-0">-->
<!--                        <a class="nav-link active" aria-current="page" href="#" role="button"-->
<!--                           data-bs-toggle="dropdown" data-bs-trigger="hover" aria-expanded="false">Trang chủ</a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </nav>-->
<!---->
<!--        <div class="d-flex gap-sm-1">-->
<!--            <a class="btn btn-primary animate-scale" href="#">-->
<!--                <span class="d-none d-xl-inline ms-1">Đăng nhập/Đăng ký</span>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
</header>

<div class="content">
    <?php
    // index.php?m=category&a=delete&id=1
    if (isset($_GET["m"])) {
        $m = $_GET["m"];

        switch ($m) {
            case 'tour':
                include 'modules/tour/index.php';
                break;
            case 'tour_category':
                include 'modules/tour_category/index.php';
                break;
            case 'user':
                include 'modules/user/index.php';
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
        <div class="d-md-flex align-items-center py-4 pt-sm-5 mt-3 mt-sm-0">
            <div class="d-flex gap-2 gap-sm-3 justify-content-center ms-md-auto mb-4 mb-md-0 order-md-2">

            </div>
            <p class="text-body-secondary fs-sm text-center text-md-start mb-0 me-md-4 order-md-1">© All rights
                reserved.</p>
        </div>
    </div>
</footer>
</body>
<!--<script src="/Tour_management/asset/js/jquery-3.7.1.js"></script>-->
<script src="/Tour_management/asset/js/boostrap.bundle.min.js"></script>
<!--<script type="text/javascript" src="/assets/js/myscript.js"></script>-->
</html>
