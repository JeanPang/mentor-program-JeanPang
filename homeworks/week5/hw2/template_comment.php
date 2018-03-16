<!-- 主留言顯示區 -->
<div class='board__comment'>
    <div class='comment__author'><? echo $row['nickname'] ?></div>
    <div class='comment__timestamp'><? echo $row['created_at'] ?></div>
    <div class='comment__content'><? echo $row['content'] ?></div>

	<button class="showhide">回應▼</button>
	<!-- 展開收起的button -->

	<div class="subboard" style="display:none;">
		<?
			//查詢子留言
			$parent_id = $row['id'];
			$sub_sql = "SELECT jeanpang_comments.*, jeanpang_users.nickname FROM jeanpang_comments left join jeanpang_users on jeanpang_users.id = jeanpang_comments.user_id where parent_id = $parent_id order by created_at DESC";
			$sub_result = $conn->query($sub_sql);

			while($sub_row = $sub_result->fetch_assoc()) {
			include('template_subcomment.php');
			//載入子留言顯示區
			} //END of while
		?>

			<?
			if (!$is_login) {
			?>
				<div class="loginRemind">於右上角登入以使用留言功能</div>
			<?
			} else {
			?>

		<!-- 子留言輸入區 -->
		<form method="POST" class="subboard__form" action="add_comment.php">
			<textarea class="subboard__form-textarea" name='content' placeholder="留言內容"></textarea>
			<input name='parent_id' type='hidden' value='<? echo $row['id'] ?>' />
			<input class='subboard__form-enter' type='submit' value='留言' />
		</form>	
			<?
			}
			?>

	</div>
</div>

