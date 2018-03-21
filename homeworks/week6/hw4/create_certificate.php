<?php
function create_certificate($user_id, $conn){

	//用uniqid()隨機生成certificate
	$certificate = uniqid();
	$cer_stmt = $conn->prepare("INSERT INTO jeanpang_users_certificate (user_id, certificate) VALUES (:user_id, :certificate)");
	$cer_stmt->bindParam(':user_id', $user_id);
	$cer_stmt->bindParam(':certificate', $certificate);
	$cer_stmt->execute();
	return $certificate;
}


/**
 * 
 *     $stmt = $conn->prepare("SELECT * FROM jeanpang_users_certificate WHERE user_id = :user_id");
	$stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    
    //先刪除舊的certificate再創建新的certificate
    if( $stmt->rowCount() ){
        $del_sql = "DELETE FROM jeanpang_users_certificate WHERE user_id = $user_id";
        $conn->exec($del_sql);
    }
*/

?>