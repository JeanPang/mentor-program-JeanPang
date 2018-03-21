<?
	require_once('conn.php');
	require_once('create_certificate.php');

	if (!empty($_POST['username'])) {
		$nickname = $_POST['nickname'];
		$username = $_POST['username'];
		//$password = $_POST['password'];

		//密碼 hash 加密處理
		$hashed_password = password_hash( $_POST['password'], PASSWORD_DEFAULT );
		//目前的PASSWORD_DEFAULT就是PASSWORD_BCRYPT


		//使用PDO & Prepared Statement 
		$sql = "INSERT INTO jeanpang_users (username, password, nickname) VALUES (:username, :password, :nickname)";
		$reg_stmt = $conn->prepare($sql);

		//bind parameters & execute
		$reg_stmt->bindParam(':username', $username);
		$reg_stmt->bindParam(':password', $hashed_password);
		$reg_stmt->bindParam(':nickname', $nickname);

		//設定 fetch mode 為 fetch_assoc
		//$reg_stmt->setFetchMode(PDO::FETCH_ASSOC);

		$result = $reg_stmt->execute();

		//註冊成功後設定cookie
		if ($result) {
			$certificate = create_certificate($conn->lastInsertId(), $conn);
			setcookie('certificate', $certificate, time()+3600*24);
		}

		//$conn->close();
		header('Location: index.php');
  }
  

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>註冊</title>
  <style type="text/css">

  </style>
  </head>
  <body>
    <h2>註冊</h2>
    <form method="POST" action="register.php">
        <div>username: <input name='username' type='text' /></div>
        <br>
        <div>password: <input name='password' type='password' /></div>
        <br>
        <div>nickname: <input name='nickname' type='text' /></div>
        <input type='submit' />
    </form>
  </body>
</html>

<?
/**
 if (!empty($_POST['username'])) {
    $nickname = $_POST['nickname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "INSERT INTO jeanpang_users (username, password, nickname) VALUES ('$username', '$password', '$nickname')";
    $result = $conn->query($sql);

    if ($result) {
      $last_id = $conn->insert_id;
      setcookie("user_id", $last_id, time()+3600*24);
    }

    $conn->close();
    header('Location: index.php');
  }
*/
?>