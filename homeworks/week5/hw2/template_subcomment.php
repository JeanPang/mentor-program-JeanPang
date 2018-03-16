
<!-- 子留言顯示區     -->
<div class='subcomment'>
    <div class='comment__author'><? echo $sub_row['nickname'] ?></div>
    <div class='comment__timestamp'><? echo $sub_row['created_at'] ?></div>
    <div class='comment__content'>
        <? echo $sub_row['content'] ?>
    </div>
</div>