<!-- 主留言顯示區 -->
<div class='board__comment'>
    <div class='comment__author'><? echo htmlspecialchars($cmmt_row['nickname']) ?></div>
    <div class='comment__timestamp'><? echo convert_time($cmmt_row['created_at']) ?></div>
	<div class="comment__edit-delete">
		<? 
		//如果這條留言的user_id等於當前用戶的 user_id，則顯示編輯/刪除按鈕
		//echo $cmmt_row['user_id'];
		if($cmmt_row['user_id'] === $login_user_id){
			echo '<button class="comment__edit">編輯</button>&nbsp;';
			echo '<button class="comment__delete">刪除</button>';
		}
		?>
	</div>
    <div class='comment__content'><? echo htmlspecialchars($cmmt_row['content']) ?></div>
	<div class="comment__id"><?php echo $cmmt_row["comment_id"] ?></div>

	<button class="showhide">回應▼</button>
	<!-- 展開收起的button -->

	<div class="subboard" style="display:none;">
		<?
			//查詢子留言
			//$parent_id = $cmmt_row['comment_id'];
			$sub_sql = "SELECT jeanpang_comments.*,jeanpang_comments.id AS comment_id, jeanpang_users.nickname FROM jeanpang_comments left join jeanpang_users on jeanpang_users.id = jeanpang_comments.user_id where parent_id = :comment_id order by created_at ASC";
			
			$sub_stmt = $conn->prepare($sub_sql);
			$sub_stmt->bindParam(':comment_id', $cmmt_row['comment_id'] );
			$sub_stmt->execute();
			$sub_stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			while($sub_row = $sub_stmt->fetch()) {
			include('template_subcomment.php');
			//載入子留言顯示區
			} //END of while
		?>

			<?
			//if (!$is_login) {
			if(!isset($_COOKIE['certificate'])){
			?>
				<div class="loginRemind">於右上角登入以使用留言功能</div>
			<?
			} else {
			?>

		<!-- 子留言輸入區 -->
			<form method="POST" class="subboard__form" action="add_comment.php">
				<textarea class="subboard__form-textarea" name='content' placeholder="留言內容"></textarea>
				<input name='parent_id' type='hidden' value='<? echo $cmmt_row['comment_id'] ?>' />
				<input class='subboard__form-submit' type='submit' value='留言' />
			</form>	
			<?
			}
			?>

	</div>
</div>

<?
/**
//mySQLi寫法
$sub_sql = "SELECT jeanpang_comments.*, jeanpang_users.nickname FROM jeanpang_comments left join jeanpang_users on jeanpang_users.id = jeanpang_comments.user_id where parent_id = $parent_id order by created_at DESC";
$sub_result = $conn->query($sub_sql);

while($sub_row = $sub_result->fetch_assoc()) {
include('template_subcomment.php');
*/
?>