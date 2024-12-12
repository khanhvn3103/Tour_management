<?php
session_start();
session_destroy();
header("location: /Tour_management/index.php");
exit();