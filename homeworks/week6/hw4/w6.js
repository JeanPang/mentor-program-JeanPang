
document.addEventListener('DOMContentLoaded', ()=>{
  
    //展開收起按鈕 處理
    var container = document.querySelector('.container')

    container.addEventListener('click', e => {
        //console.log(e.target.className)
        if(e.target.className === 'showhide' ){
            if( e.target.innerText ==='回應▼' ){
                e.target.innerText = '回應▲';
                e.target.nextElementSibling.style.display = 'block';
            }else{
                e.target.innerText = '回應▼';
                e.target.nextElementSibling.style.display = 'none';     
            }
        }
      
        //編輯完成按鈕處理
        //編輯完成要在上面，不然會造成bug
		if(e.target.className === 'comment__edited'){
            var content = e.target.parentNode.nextElementSibling;
            var comment_id = content.nextElementSibling;

			//必填檢查
			if(chkRequired(content)){
                let req = new XMLHttpRequest();
                
                req.onload = () =>{
					if(req.status >= 200 && req.status < 400){
                        window.location.reload();
                        //alert(req.responseText);
						//if(req.responseText === 'modified'){
                            //window.location.reload();
						//}
					}
                }
                
                req.open('POST', 'modify_comment.php', true);
                req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                req.send('comment_id=' + comment_id.innerText + '&content=' + encodeURIComponent(content.value));
            }
        }



        

        //編輯留言按鈕處理
        if(e.target.className === 'comment__edit'){
            var content = e.target.parentNode.nextElementSibling;
            var newTextArea = document.createElement('textarea');
            newTextArea.className = 'comment__textarea';
            //顯示留言區塊轉換成textarea
            newTextArea.innerText = content.innerText;
            content.outerHTML = newTextArea.outerHTML;
            e.target.innerText = '完成';
            e.target.className = 'comment__edited';
        }

        //刪除留言按鍵處理
        if(e.target.className === 'comment__delete'){
            var content = e.target.parentNode.nextElementSibling;
            var comment_id = content.nextElementSibling;
            
            //必填檢查
            if( chkRequired(content) ){
                let req = new XMLHttpRequest();

                req.onload = () =>{
                    if( req.status >= 200 && req.status < 400 ){
                        if( req.responseText === 'deleted' ){
                            window.location.reload();
                        }

                    }
                }
                
                req.open( 'POST', 'delete_comment.php', true );
                req.setRequestHeader( 'Content-type', 'application/x-www-form-urlencoded' );
                req.send( 'comment_id=' + comment_id.innerText );
            }
        }
        
    }) 
});

 

function chkRequired(field){
    if(field.value === '') return false;
    else return true;
}
