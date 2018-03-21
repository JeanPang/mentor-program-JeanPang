					<?
						//載入連線的資料庫
						require_once('conn.php');
						require_once('convert_time.php');
						$login_user_id = 0;

						if(isset($_COOKIE['certificate'])){
							//用cookie中的certificate尋找登入者的id和nickname
							$user_sql = "SELECT id, nickname from jeanpang_users inner join jeanpang_users_certificate on certificate = :certificate and id = user_id";
							$user_stmt = $conn->prepare($user_sql);
							$user_stmt->bindParam(':certificate', $_COOKIE['certificate']);
							$user_stmt->execute();
							$user_stmt->setFetchMode(PDO::FETCH_ASSOC);
							
							$user_row = $user_stmt->fetch();
							$login_user_id = $user_row['id'];
							//echo $user_row['id'];
						}
					?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>w6：留言板+會員系統+安全性</title>
		<link rel="stylesheet" type="text/css" href="w6.css" />
		<script type="text/javascript" src="w6.js"></script>
  </head>

  <body>
    <div class="navbar"> 
		<div class="navbar__logo">Jean's blog</div>
		<div class="navbar__login">
					<?
					//判斷有沒有登入
					if(!isset($_COOKIE['certificate'])){
						//沒有登入的話
					?>
					<button class="navbar-space"><a href='register.php'>註冊</a></button>
					<button class="navber-space"><a href='login.php'>登入</a></button>
					
					<? } else {
						//登入的話
					?>

					<button class="navber-space"><a href='logout.php'>登出</a></button>
					<? }
					?>
				

		</div>
    </div>

    <div class='container'>
		<div class="article">
			<div class="article__title">可西一土的會藝可道</div>
			<div class="article__content"> 
				<p>他上生紀界一料決來腳創發，實背回；門位也一活水始！處飯能為？其寫度心行源關報聯影，教開管，只紅見！
				<p>在親臺，山提大開了，品壓當學小正人大縣真庭體成視，物之動以華斷技，入我深倒想。身去們月們的！表傳集花和委法規放過這極軍，他海用夫較。
				<p>馬保外人這和子進故國：們見些開解不？絕的世人一明於中生格黑現品才事比格完活不白前留吸是場動父。現覺作因。個生於人起打海：不自不展？成雖體家求是一現切減……到女山看上一人只適他吃教過大從苦果但父，放其的輕生這分心於進臺製。著多離；天統得留但美包計本面，城生主的打影大德須們子起……天孩由機現麼此？前度家。
			</div>
		</div>

        <div class="board">
			<div class="board__title">留言區
			</div>
					<?	
						//查詢主要留言筆數
						$pages_sql = "SELECT COUNT(parent_id) AS datanum FROM jeanpang_comments WHERE parent_id = 0";
						$pages_result = $conn->query($pages_sql);
						$pages_result->setFetchMode(PDO::FETCH_ASSOC);
						$pages_row = $pages_result->fetch();

						//確認總頁數
						$pagesnum = ceil ($pages_row['datanum'] / 10);

						//設定目前所在頁數
						if(!isset($_GET['page'])) $page=1;
						else $page =  intval($_GET['page']);

						//查詢目前頁面需要的十筆主留言
						$cmmt_sql = "SELECT jeanpang_comments.id AS comment_id, jeanpang_comments.content, jeanpang_comments.created_at, jeanpang_comments.user_id, jeanpang_users.nickname FROM jeanpang_comments left join jeanpang_users on jeanpang_comments.user_id = jeanpang_users.id where parent_id = 0 order by created_at DESC " . 
								"LIMIT " . ($page-1)*10 . ", 10";
						//order by created_at DESC 降冪排序
						
						
						$cmmt_result = $conn->query($cmmt_sql);
						//讀取資料庫資料
						//把要操作的語法丟進query()這個函式中，便會傳回結果
						$cmmt_result->setFetchMode(PDO::FETCH_ASSOC);
						
						//print_r($sql);

						while($cmmt_row = $cmmt_result->fetch()) {
							//迴圈擷取資料的第一行(值)，此句打兩次就會出現第二行，打三次出現第三行...
						require('template_comment.php');
						//載入主留言顯示區
						}
					?>

			<div class="pagesnum">
				<ul>
					<?php
					//設定頁碼
					for($i=1; $i <= $pagesnum; $i++){

					//如果是目前頁面的頁碼不做連結
					if($i === $page) echo "<li><b>[$i]</b> </li>";
					else echo "<li><a href='index.php?page=" . $i . "'>" . $i . "</a> </li>";
					}
					?>
				</ul>
			</div>

					<?
					//if (!$is_login) {
					if(!isset($_COOKIE['certificate'])){
					?>
						<div class="loginRemind">於右上角登入以使用留言功能</div>
					<?
					} else {

				?>
						
			<div class='board__form-title'>我要留言</div>
			<form method='POST' class="board__form" action='add_comment.php'>
				<textarea class="board__form-textarea" name='content' placeholder="留言內容"></textarea>
				<input type='hidden' name='parent_id' value='0' />
				<!-- 隱藏欄位用來儲存parent_id=0（主留言）的資訊 -->
				<input class='board__form-submit' type='submit' value='留言' />	
			</form>
					<?
					}
					?>
				
		</div> <!-- END of board-->
    </div> <!-- END of container -->
  </body>
</html>
