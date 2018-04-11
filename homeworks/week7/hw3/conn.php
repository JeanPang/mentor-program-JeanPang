<?php

$servername = "localhost";
$username = "mentor_admin";
$password = "mentor_admin123";
$dbname = "mentor_program_db";
$cmmts_table = "jeanpang_comments";
$users_table = "jeanpang_users";
//$certificates_table = "kristxeng_users_certificate";

//使用PDO存取資料庫時，需要將資料庫依下列格式撰寫，讓程式讀取資料庫
$dbconnect = "mysql:host=$servername;dbname=$dbname;charset=utf8";

//用 PDO 方式改寫

try{
	//建立MySQL伺服器連接和開啟資料庫 
	$conn = new PDO($dbconnect, $username, $password);
    //指定PDO錯誤模式和錯誤處理
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected Success";
}

catch(PDOException $e){

	echo "Connected Failed: " . $e->getMessage();
}

?>


