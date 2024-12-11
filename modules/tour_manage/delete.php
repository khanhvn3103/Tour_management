<?php
$model = new modelTour();

$id = $_GET['ids'];
$model->deleteMultipleTours($id);
header('location:/Tour_management/modules/tour_manage/index.php');
exit;
?>
