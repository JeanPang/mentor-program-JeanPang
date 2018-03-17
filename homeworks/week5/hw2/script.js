
document.addEventListener('DOMContentLoaded', ()=>{
  
    //展開收起
    var container = document.querySelector('.container')

    container.addEventListener('click', e => {
      console.log(e.target.className)
      if(e.target.className === 'showhide' ){

        //var element = document.querySelector('.childareabox');



        if( e.target.innerText ==='回應▼' ){
          e.target.innerText = '回應▲';
          e.target.nextElementSibling.style.display = 'block';
        
        }else{
          e.target.innerText = '回應▼';
          e.target.nextElementSibling.style.display = 'none';
        
        }
      }
    })

    //驗證
    /** 
    document.querySelector('.login__btn').addEventListener('click', ()=>{

      let username = document.querySelector('[name=username]');
      let password = document.querySelector('[name=password]');

      //ajax，不重新載入頁面地送出資料
      if(chkRequired(username) && chkRequired(password)){
          //如果username和password填了，就send出POST的request
          let req = new XMLHttpRequest();

          req.onload = () =>{
              if(req.status >= 200 && req.status < 400){

                  if(req.responseText === 'error'){
                      //如果有問題
                      alert("帳號/密碼 錯誤！");
                  }

                  if(req.responseText === 'ok'){
                      //如果成功
                      alert("登入成功！");
                      document.location.href = 'index.php';
                  }
              }
          }

          req.open('POST', '/Jean/login.php', true);
          //傳送POST的request到login.php（請求頁面）
          req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          //client端傳給server端文本內容的編碼方式，是url編碼，除了標準字符外，每字節以雙字節16進制前價格"%"表示
          req.send('username='+username.value+'&password='+password.value);
          
      }else{
          //如果沒填就show提醒
          alert("以上皆為必填項目！");
      }
      }) //END of querySelector('.login__btn')


      function chkRequired(field){
      if(field.value === '') return false;
      else return true;
      } */
        
      
  });
