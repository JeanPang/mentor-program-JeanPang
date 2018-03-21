<?php
require_once('conn.php');
$stmt = $conn->prepare("UPDATE jeanpang_comments SET content = :content WHERE id = :comment_id");
$stmt->bindParam(':comment_id', $_POST['comment_id']);
$stmt->bindParam(':content', $_POST['content']);
if( $stmt->execute() ){
	echo 'modified';
}else{
	echo 'error';
}
?>

