
<!-- 子留言顯示區     -->
<div class='subcomment'>
    <div class='comment__author'><? echo htmlspecialchars($sub_row['nickname']) ?></div>
    <div class='comment__timestamp'><? echo convert_time($sub_row['created_at']) ?></div>
    <div class="comment__edit-delete">
		<? 
		//如果這條留言的user_id等於當前用戶的 user_id，則顯示編輯/刪除按鈕
		//echo $cmmt_row['user_id'];
		if($sub_row['user_id'] === $login_user_id){
			echo '<button class="comment__edit">編輯</button>&nbsp;';
			echo '<button class="comment__delete">刪除</button>';
		}
		?>
	</div>
    <div class='comment__content'><? echo $sub_row['content'] ?></div>
    <div class="comment__id"><?php echo $sub_row["comment_id"] ?></div>
</div>