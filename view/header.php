<?php
session_start();
?>
<header class="navbar navbar-expand-lg navbar-light w-100" id="header">
    <div class="container-lg">
        <div class="d-flex align-content-center">
            <a class="navbar-brand" href="/Tour_management/index.php"> <img src="asset/images/travellowkey_logo.png" class="logo"></a>
            <ul class="navbar-nav">
                <li class="nav-item dropdown pt-lg-3 pb-lg-2 me-lg-n1 me-xl-0 <?php if (!isset($m)) echo 'active' ?>">
                    <a class="nav-link <?php if (!isset($m)) echo 'active' ?>" href="/Tour_management">TRANG CHỦ</a>
                </li>
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <li class="nav-item dropdown pt-lg-3 pb-lg-2 me-lg-n1 me-xl-0 <?php if ($m == 'user') echo 'active' ?>">
                        <a class="nav-link <?php if ($m == 'user') echo 'active' ?>" href="/Tour_management/index.php?m=user">THÔNG TIN CỦA TÔI</a>
                    </li>
                    <?php
                    if ($_SESSION['role'] == 'admin') {
                    ?>
                        <li class="nav-item dropdown pt-lg-3 pb-lg-2 me-lg-n1 me-xl-0">
                            <a class="nav-link" href="Tour_management/modules/manager_home/manager_home.php">QUẢN TRỊ</a>
                        </li>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>


            </ul>
        </div>
        <div>
            <?php
            if (!isset($_SESSION['user'])) {
            ?>
                <button class="btn btn-secondary me-1" onclick="redirectToSignup()">Đăng ký</button>
                <button class="btn btn-primary" onclick="redirectToLogin()">Đăng nhập</button>
            <?php
            } else {
            ?>
                <div class="d-flex align-items-center justify-content-end">
                    <a class="nav-link me-3" href="/Tour_management/index.php?m=notifications">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
                        </svg>
                    </a>

                    <p class="full_name me-3 mb-0">Xin chào, <?php echo $_SESSION['user']['fullName'] ?></p>
                    <img src="https://www.clipartmax.com/png/small/30-301819_tourist-travel-icon-png.png" alt="Tourist Travel" width="40" style="border-radius: 100%" />
                </div>
            <?php
            }
            ?>



        </div>
        <script>
            function redirectToSignup() {
                window.location.href = "http://localhost/Tour_management/modules/authenticate/sign_up.php";
            }

            function redirectToLogin() {
                window.location.href = "http://localhost/Tour_management/modules/authenticate/newlogin.php";
            }
        </script>
    </div>
</header>
<script type="text/javascript">
    window.onscroll = function() {
        const header = document.getElementById("header");
        if (window.pageYOffset > 10) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    };
</script>