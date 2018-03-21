<?php
require_once('conn.php');
$sql = "DELETE FROM jeanpang_comments where id = :comment_id OR parent_id = :comment_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':comment_id', $_POST['comment_id']);
if( $stmt->execute() ){
	echo 'deleted';
}else{
	echo 'error';
}
?>