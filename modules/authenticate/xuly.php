<?php	
	include('config.php');
	
	// Them du lieu
	if(isset($_POST['name'])&& isset($_POST['email'])&& isset($_POST['phone'])&& isset($_POST['ngay'])&& isset($_POST['tour'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$ngay = $_POST['ngay'];
		$tour = $_POST['tour'];
	}

		$truyvan = "INSERT INTO dangky (name, email, phone, ngay, tour)
				VALUES ('".$name."', '".$email."', '".$phone."', '".$ngay."', '".$tour."');";		
		$thucthi=pg_query($dbcon,$truyvan);
		
		header("Location: ./sign_up.php");
		
	if(isset($_POST['username'])&& isset($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
	
		$truyvan = "INSERT INTO dangnhap (username, password )
				VALUES ('".$username."', '".$password."');";
		$thucthi=pg_query($dbcon,$truyvan);
	
	
	}	
?>