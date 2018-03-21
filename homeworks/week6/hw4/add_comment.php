<?php
	require_once('conn.php');
	
	//用cookie中的certificate尋找登入者的user_id
	$chk_sql = "SELECT user_id FROM jeanpang_users_certificate WHERE certificate = :certificate";
	$chk_stmt = $conn->prepare($chk_sql);
	$chk_stmt->bindParam(':certificate', $_COOKIE[certificate]);
	$chk_stmt->execute();
	$chk_stmt->setFetchMode(PDO::FETCH_ASSOC);
	$chk_row = $chk_stmt->fetch();

	$sql = "INSERT INTO jeanpang_comments (user_id, content, parent_id) VALUES (:user_id, :content, :parent_id)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':user_id', $chk_row['user_id']); //亂數session的user_id
	$stmt->bindParam(':content', $_POST['content']);
	$stmt->bindParam(':parent_id', $_POST['parent_id']);

	if($stmt->execute()){
	header("Location: ./index.php");
}
?>


<?
/** //之前mySQLi寫法
 <?
  require_once('conn.php');

  $nickname = $_POST['nickname'];
  $content = $_POST['content'];
  $parent_id = $_POST['parent_id'];
  $user_id = $_COOKIE['user_id'];
  $sql = "INSERT INTO jeanpang_comments (user_id, content, parent_id) VALUES ($user_id, '$content', $parent_id)";
  $conn->query($sql);
  $conn->close();
  header('Location: index.php');
?>
 */
?>
