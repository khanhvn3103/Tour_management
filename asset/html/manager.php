<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../asset/css/bootstrap.min.css" />
    <title>Manager_Home</title>
    <style>
        body{
            background: rgb(8,80,120);
            background: linear-gradient(90deg, rgba(8,80,120,1) 0%, rgba(56,149,179,1) 50%, rgba(133,216,206,1) 100%);
        }
        .a{
            width: 315px;
        }
        a {
            /* color: aliceblue; */
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header></header>\
    <div class="container">
        <div class="col m-5">
            <div class="row bg-light justify-content-around">
                <div class="col-5 m-5 text-center">
                    <img
                    src="../../asset/images/avt.jpg"
                    alt="ảnh đại diện"
                    class="img-fluid rounded-circle"
                    style="width: 300px; height: 300px"
                    />
                </div>
                <div class="col-5">
                    <div class="row mt-5">
                        <div class="col-6">
                            <p class="mt-5">Họ và tên: fullName</p>
                            <p class="mt-5">Địa chỉ: address</p>
                            <p class="mt-5">Số điện thoại: phone</p>
                        </div>
                        <div class="col-6">
                            <p class="mt-5">Ngày sinh: dob</p>
                            <p class="mt-5">Giới tính: gender</p>
                            <p class="mt-5">Chức vụ: role</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 justify-content-between">
                <div class="a col-2 fs-4 text-center bg-light">
                    <a class="fw-bold" href="./signup.php">Thêm tài khoản</a>
                </div>
                <div class="a col-2 fs-4 text-center bg-light">
                    <a class="fw-bold" href="./user/">Thêm tài khoản</a>
                </div>
                <div class="a col-2 fs-4 text-center bg-light">
                    <a class="fw-bold" href="./user/">Thêm tài khoản</a>
                </div>
                <div class="a col-2 fs-4 text-center bg-light">
                    <a class="fw-bold" href="./user/">Thêm tài khoản</a>
                </div>
            </div>
        </div>
    </div>
    <footer></footer>
</body>
</html>