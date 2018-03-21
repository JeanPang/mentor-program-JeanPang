<?

  //setcookie("user_id", '', time()+3600*24);
  setcookie( 'certificate', '', time()-3600*24 );
  //第二個參數放空字串，也就是清空cookie的user_id
  header('Location: index.php');
  //轉址回主頁
?>