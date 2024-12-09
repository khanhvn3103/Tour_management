<?php
$model = new modelSpot();

if (isset($_GET['ids'])) {
    $ids = explode(',', $_GET['ids']);
    foreach ($ids as $id) {
        $model->deleteSpot($id);
    }
    header('location:/Tour_management/modules/sightseeing_spot/index.php');
    exit;
}
?>
