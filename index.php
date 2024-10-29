
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1px solid" style="margin: auto; text-align: center; width: 960px;">
        <tr class="normal">
            <td colspan="2">Banner</td>
        </tr>
        <tr class="normal">
            <td id="left">
                <a href="index.php">Trang chủ</a>
                <a href="admin.php">Quản lý</a>
            </td>
            <td id="right">
                <form action="index.php?act=product" method="GET">
                    <input type="search" name="kw" class="input" id="search" placeholder="Tìm kiếm sản phẩm...">
                    <input type="submit" name="search" value="Tìm kiếm">
                </form>
            </td>
        </tr>
        <tr class="normal">
            <td id="left">
                <?php
                    include_once('View/CongTy/vCompany.php');
                ?>
            </td>
            <td id="main">
                <?php
                    include_once('View/SanPham/vProduct.php');
                ?>
            </td>
        </tr>
        <tr class="normal">
            <td colspan="2">Footer</td>
        </tr>

        <h1>Quyên</h1>
    </table>

    aaaaaaaaaaaa
    <h1>Khanh 2</h1>
</body>
</html>
