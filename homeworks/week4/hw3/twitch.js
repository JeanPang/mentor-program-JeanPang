document.addEventListener('DOMContentLoaded', ()=>{
    var request = new XMLHttpRequest();
      var viewbox = document.querySelector('.viewbox');
    
      request.open('GET', 'https://api.twitch.tv/kraken/streams/?game=League%20of%20Legends', true);
    //用open發送一個request
      request.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');
      request.setRequestHeader('Client-ID', 'hslws7ppuhhf6i77cz09ezqicgnog1');
    //用自定義header帶參數
    
      request.onload = () =>{
    //資料載入時處理的function
          if(request.status >= 200 && request.status < 400){
            response = JSON.parse(request.responseText);
              //成功的話載入response內容
        
              showViewbox(viewbox, 0);
        //顯示第一個viewbox
        
              for(var i=1; i < 20; i++){
                  var copyViewbox = viewbox.cloneNode(true);
                  showViewbox(copyViewbox, i);
          //用迴圈把剩下帶viewbox複製出來
                  document.querySelector('.container').appendChild(copyViewbox);
          //append到container原本的內容之後
        }
        
              function showViewbox(viewbox, n){
        //viewbox顯示的內容，用api物件載入
                viewbox.firstElementChild.firstElementChild.firstElementChild.setAttribute('src', response.streams[n].preview.medium);
          //載入preview_img的圖片
                  viewbox.lastElementChild.firstElementChild.firstElementChild.setAttribute('src', response.streams[n].channel.logo);
          //載入channel_logo
                  viewbox.lastElementChild.lastElementChild.firstElementChild.innerText = response.streams[n].channel.status;
          //載入channel_status
                  viewbox.lastElementChild.lastElementChild.lastElementChild.innerText = response.streams[n].channel.display_name;
          //載入display_name
                  viewbox.firstElementChild.firstElementChild.setAttribute('href', response.streams[n].channel.url);
          //載入url
              }
          }
      }
      request.send();
    //送出request
  })