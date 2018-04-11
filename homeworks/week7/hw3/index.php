<?
session_start();
//啟用session
require_once 'conn.php';
//連接資料庫
require_once 'convert_time.php';
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Jean_w7-留言板改寫</title>
		<meta name="description" content="mentor program week7 hw3" />

		<!--  Boorstrap StyleSheet  -->
		<link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="w7.css" />

		<!--  jQuery  -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!--  Bootstrap JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="w7.js"></script>
	</head>
	<body>
		<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="/">Jean's blog</a>
			<div class="navbar__right">
				<?
//確認session中是否有user_id(用戶是否登入)
if (!isset($_SESSION['user_id'])) {
    //沒有登入的話
    ?>
				<button class="btn btn-secondary my-2 my-sm-0" type="submit" onclick="window.location.href='reg.php'">註冊</button> &nbsp;&nbsp;&nbsp;&nbsp;
				<button class="btn btn-secondary my-2 my-sm-0" type="submit" onclick="window.location.href='login.php'">登入</button>

				<?} else {
    //登入的話
    ?>
				<button class="btn btn-secondary my-2 my-sm-0" type="submit" onclick="window.location.href='logout.php'">登出</button>
				<?}
?>
			</div>
		</nav>

		<div class="container-fluid container">
			<div class="article">
				<div class="article__title">可西一土的會藝可道</div>
				<br>
				<div class="article__content">
					<p>他上生紀界一料決來腳創發，實背回；門位也一活水始！處飯能為？其寫度心行源關報聯影，教開管，只紅見！
					<p>在親臺，山提大開了，品壓當學小正人大縣真庭體成視，物之動以華斷技，入我深倒想。身去們月們的！表傳集花和委法規放過這極軍，他海用夫較。
					<p>馬保外人這和子進故國：們見些開解不？絕的世人一明於中生格黑現品才事比格完活不白前留吸是場動父。現覺作因。個生於人起打海：不自不展？成雖體家求是一現切減……到女山看上一人只適他吃教過大從苦果但父，放其的輕生這分心於進臺製。著多離；天統得留但美包計本面，城生主的打影大德須們子起……天孩由機現麼此？前度家。
				</div>
				<br>
				<ul class="board__title nav nav-pills flex-column">
					<li class="nav-item nav-link active">
						留言區
					</li>
				</ul>
			</div>

			<?
//查詢主要留言筆數
$pages_stmt = $conn->prepare("SELECT COUNT(parent_id) AS datanum FROM $cmmts_table  WHERE parent_id = 0");
$pages_stmt->execute();
$pages_stmt->setFetchMode(PDO::FETCH_ASSOC);
$pages_row = $pages_stmt->fetch();

//$pagesnum 總頁數
$pagesnum = (int) ceil($pages_row['datanum'] / 10);

//$page 目前頁碼，如果沒有 $_GET，或是 $_GET 非數字，則 $page=1
if (!isset($_GET['page']) or !intval($_GET['page'])) {
    $page = 1;
} else {
    $page = intval($_GET['page']);
}

//計算本頁顯示的第一筆留言起始值
$cmmt_start_num = ($page - 1) * 10;

//查詢目前頁面需要的十筆主留言
$cmmt_stmt = $conn->prepare("SELECT c.id AS cmmt_id, user_id, nickname, created_at, content FROM $cmmts_table AS c INNER JOIN" .
    " $users_table ON parent_id = 0 AND user_id = $users_table.id ORDER BY created_at DESC LIMIT $cmmt_start_num, 10");

$cmmt_stmt->execute();
$cmmt_stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($cmmt_row = $cmmt_stmt->fetch()) {
    ?>

					<!--  主留言外框 START  -->
					<div class="cmmt-box col-lg-11 col-sm-10 mx-auto mb-2 p-4 board__comment card border-success">

						<!--  顯示主留言 START  -->
						<div class="cmmt__header">
							<div class="cmmt__nickname cmmt__author"><?echo htmlspecialchars($cmmt_row["nickname"]) ?></div>
						<div>

						<div class="cmmt__edit-delete">

			<?//如果已登入，且這條留言的user_id等於當前用戶的 user_id，則顯示編輯/刪除按鈕
    if (isset($_SESSION['user_id']) and $cmmt_row['user_id'] === $_SESSION['user_id']) {
        echo '<span class="cmmt__edit">編輯</span>&nbsp;/&nbsp';
        echo '<span class="cmmt__delete">刪除</span>';
    }
    ?>
								</div>
								<div class="cmmt__time"><?echo convert_time($cmmt_row["created_at"]) ?></div>
							</div>
						</div>
						<div class="cmmt__content"><?echo htmlspecialchars($cmmt_row["content"]) ?></div>
						<div class="cmmt__id"><?echo $cmmt_row["cmmt_id"] ?></div>

					<!--  顯示子留言串 START  -->

			<?
	//查詢子留言
    $sub_stmt = $conn->prepare("SELECT c.id AS cmmt_id, user_id, nickname, created_at, content FROM $cmmts_table AS c INNER JOIN $users_table WHERE parent_id = :cmmt_id AND user_id = $users_table.id ORDER BY created_at ASC");
    $sub_stmt->bindParam(':cmmt_id', $cmmt_row['cmmt_id']);
    $sub_stmt->execute();
    $sub_stmt->setFetchMode(PDO::FETCH_ASSOC);
    while ($sub_row = $sub_stmt->fetch()) {
		?>
		
<div class="sub-cmmt sub-cmmt__main-author col-11">
								<div class="cmmt__header">
									<div class="cmmt__nickname ammt__author"><?echo htmlspecialchars($sub_row["nickname"]) ?></div>
									<div>
										<div class="cmmt__edit-delete">

											<?//如果已登入，且這條留言的user_id等於當前用戶的 user_id，則顯示編輯/刪除按鈕
        if (isset($_SESSION['user_id']) and $sub_row['user_id'] === $_SESSION['user_id']) {

            echo '<span class="cmmt__edit">編輯</span>&nbsp;/&nbsp';
            echo '<span class="cmmt__delete">刪除</span>';
        }
        ?>
										</div>
										<div class="cmmt__time"><?echo convert_time($sub_row["created_at"]) ?></div>
									</div>
								</div>
								<div class="cmmt__content"><?echo htmlspecialchars($sub_row["content"]) ?></div>
								<div class="cmmt__id"><?echo $sub_row["cmmt_id"] ?></div>
							</div>


			<?
    } //END of 子留言查詢 while
    ?>
							<!--   子留言的撰寫框 START  -->
							<div class="sub-cmmt sub__form">

			<?
//如果有登入，顯示回應按鍵
    if (isset($_SESSION['user_id'])) {
        ?>

								<div class="sub-cmmt__collapse-toggle">回應▼</div>
								<div>
									<textarea class="cmmt__textarea" name="content" placeholder="留言內容" required></textarea>
									<input type="hidden" name="parent_id" value=<?echo $cmmt_row['cmmt_id'] ?> />
									<input class="cmmt__btn sub-cmmt__btn btn btn-success" type="submit" value="留 言" />
								</div>

			<?
    } else {
        ?>

								<a class="sub-cmmt__login-link text-info" onclick="location.href='login.php'">
									登入以發表回應
								</a>

			<?
    }
    ?>

							</div>
						</div>

			<?
} //END of 主留言查詢 while
?>

			<div class='board__form-title'>我要留言</div>

			<!--  主要留言的撰寫框 START  -->
			<div class="cmmt-box col-lg-11 col-sm-10 mx-auto mb-2 p-4">

			<?
//以確認 session 中是否有user_id，來認定用戶是否登入
if (isset($_SESSION['user_id'])) {

    //用 session 中的 user_id 尋找登入者的nickname
    $user_stmt = $conn->prepare("SELECT nickname FROM $users_table WHERE id = :user_id");
    $user_stmt->bindParam(':user_id', $_SESSION['user_id']);
    $user_stmt->execute();
    $user_stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user_row = $user_stmt->fetch();
    ?>

						<div>
							<div class="cmmt__nickname cmmt__author">
								<?echo htmlspecialchars($user_row['nickname']) ?>
							</div>
							<textarea class="cmmt__textarea" name="content" placeholder="留言內容" required></textarea>
							<input type="hidden" name="parent_id" value='0' />
							<input class="cmmt__btn btn btn-success" type="submit" value="留 言" />
						</div>

			<?
} else { //如果未登入，顯示登入框
    ?>
	<a class="sub-cmmt__login-link text-info" onclick="location.href='login.php'">
	登入以發表回應
</a>
<?
}
?>

			</div>
			<!--  主要留言的撰寫框END  -->


			<!-- Bootstrap 分頁 START -->
			<nav aria-label="comment board pages" class="my-5">
				<ul class="pagination justify-content-center">

			<?
//如果目前在第一頁，前一頁連結失效
if ($page === 1) {

    echo '<li class="page-item disabled">';
    echo '<a class="page-link" href="#" aria-label="Previous" tabindex="-1">';

} else {

    echo '<li class="page-item">';
    echo '<a class="page-link" href="index.php?page=' . ($page - 1) . '" aria-label="Previous">';

}
?>
							<span aria-hidden="true">&laquo;</span>
							<span class="sr-only">Previous</span>
						</a>
					</li>

			<?

for ($i = 1; $i <= $pagesnum; $i++) {
    if ($i === $page) {
        //目前頁面的頁碼連結失效
        echo '<li class="page-item disabled"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
    } else {
        //非目前頁面的頁碼連結正常
        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
    }

}

//如果目前在最後一頁，後一頁連結失效
if ($page === $pagesnum) {

    echo '<li class="page-item disabled">';
    echo '<a class="page-link" href="#" aria-label="Next" tabindex="-1">';

} else {

    echo '<li class="page-item">';
    echo '<a class="page-link" href="index.php?page=' . ($page + 1) . '" aria-label="Next">';
}
?>
							<span aria-hidden="true">&raquo;</span>
							<span class="sr-only">Next</span>
						</a>
					</li>
				</ul>
			</nav>
			<!-- Bootstrap 分頁 END -->
			<br>

		</div> <!-- END of container-fluid -->
	</body>
</html>