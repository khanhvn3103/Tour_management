<?php
$model = new modelTourPackage();

$id = $_GET['ids'];
$model->deleteMultipleTourPackages($id);
header('location:/Tour_management/modules/tour_package/index.php');
exit;