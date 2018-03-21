<?
  	require_once('conn.php');
	require_once('create_certificate.php');

	$error_message = '';

	if (!empty($_POST['username'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		//密碼 hash 加密處理
		$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		//目前的PASSWORD_DEFAULT就是PASSWORD_BCRYPT

		//使用PDO & Prepared Statement 
		$sql = "SELECT id, username, password FROM jeanpang_users where username = :username";
		$stmt = $conn->prepare($sql);

		//bind parameters & execute
		$stmt->bindParam(':username', $username);
		//$stmt->bindParam(':password', $password);
		$stmt->execute();

		//設定 fetch mode 為 fetch_assoc
		$stmt->setFetchMode(PDO::FETCH_ASSOC);

		if ($stmt->rowCount() > 0) {
			$row = $stmt->fetch();

			if(password_verify($password, $hashed_password)){
				$certificate = create_certificate($row['id'], $conn);
				setCookie('certificate', $certificate, time()+3600*24);
				//設置cookie
				header('Location: index.php');
				echo '密碼匹配';
			}else{
				echo '密碼錯誤';
			}
		} else {
		$error_message = '帳號或密碼錯誤';
		};
		//$conn->close()
	};
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>登入</title>
  <style type="text/css">

  </style>
  </head>
  <body>
    <h2>登入</h2>
    <?
      if ($error_message !== '') {
        echo $error_message;
      }
    ?>
    <form method="POST" action="login.php">
        <div>username: <input name='username' type='text' /></div>
        <br>
        <div>password: <input name='password' type='password' /></div>
        <br>
        <input type='submit' />
    </form>
  </body>
</html>


<?
	/** //原本用mySQLi
	if (!empty($_POST['username'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM jeanpang_users where username='$username' and password='$password'";

		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) { //msqli用num_rows
			$row = $result->fetch_assoc();
			setcookie("user_id", $row['id'], time()+3600*24);
			//設置cookie
			header('Location: index.php');
		} else {
			$error_message = '帳號或密碼錯誤';
		}
			$conn->close();
	}
	*/
?> 