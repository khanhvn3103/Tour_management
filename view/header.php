<header class="navbar navbar-expand-lg navbar-light p-2 w-100" id="header">
    <div class="container-lg">
        <div class="d-flex align-content-center">
            <a class="navbar-brand" href="/"> <img src="asset/images/travellowkey_logo.png" class="logo"></a>
            <ul class="navbar-nav">
                <li class="nav-item dropdown pt-lg-3 pb-lg-2 me-lg-n1 me-xl-0 <?php if(!isset($m)) echo 'active'?>">
                    <a class="nav-link <?php if(!isset($m)) echo 'active'?>"  href="/Tour_management">TRANG CHỦ</a>
                </li>
                <li class="nav-item dropdown pt-lg-3 pb-lg-2 me-lg-n1 me-xl-0 <?php if($m == 'user') echo 'active'?>">
                    <a class="nav-link <?php if($m == 'user') echo 'active'?>" href="/Tour_management/index.php?m=user">THÔNG TIN CỦA TÔI</a>
                </li>
                <li class="nav-item dropdown pt-lg-3 pb-lg-2 me-lg-n1 me-xl-0 <?php if($m == 'notifications') echo 'active'?>">
                    <a class="nav-link <?php if($m == 'notifications') echo 'active'?>" href="/Tour_management/index.php?m=notifications">THÔNG BÁO</a>
                </li>
            </ul>
        </div>
        <div>
            <button class="btn btn-secondary me-1" onclick="redirectToSignup()">Đăng ký</button>
            <button class="btn btn-primary" onclick="redirectToLogin()">Đăng nhập</button>
        </div>
        <script>
            function redirectToSignup() {
                window.location.href = "http://localhost/Tour_management/modules/authenticate/sign_up.php";
            }

            function redirectToLogin() {
                window.location.href = "http://localhost/Tour_management/modules/authenticate/login.php";
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