<?php
session_start();

require_once('conn.php');


//密碼 hash 加密處理
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
//目前的PASSWORD_DEFAULT就是PASSWORD_BCRYPT

//使用PDO & Prepared Statement 
$stmt = $conn->prepare("SELECT id, username, password FROM $users_table WHERE username = :username");
//bind parameters & execute
$stmt->bindParam(':username', $_POST['username']);

//$stmt->bindParam(':password', $_POST['password']);
$stmt->execute();

//設定 fetch mode 為 fetch_assoc
$stmt->setFetchMode(PDO::FETCH_ASSOC);

if( $stmt->rowCount() === 1 ){

	$row = $stmt->fetch();

	if(password_verify($password, $hashed_password)){
	//if( password_verify( $_POST['password'], $row['password'] ) ){

		//用 uniqid() 隨機生成 certificate
		//$certificate = uniqid();

		//設定session內的certificate
		//$_SESSION['certificate'] = $certificate;

		//設定 session 中的 user_id
		$_SESSION['user_id'] = $row['id'];

		//設定cookie內的certificate
		//setCookie('certificate', $certificate, time()+3600*24);

		header('Location: index.php');
		echo 'ok';

	}else{

		 echo 'error';
	}
	
}else{

	echo 'error';
}

?>