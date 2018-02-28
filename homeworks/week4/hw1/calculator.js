
document.addEventListener('DOMContentLoaded',() =>{
    document.querySelector('.btnpad').addEventListener('click', e => {
    //按到鍵盤時做出事件回應
    //console.log(e.target.id)
        var arr = []
        var result = document.querySelector('.result')
        
        if(e.target.id === 'ac' ){
            result.innerText = '0'
        }
        //按ac時清空
        
        if(e.target.className === 'btn num' ){
            result.innerText += e.target.innerText  
        }   
        //按多個0（數值為0）時顯示也是一個0
            
        if(e.target.className === 'btn cal' ){
            result.innerText += e.target.innerText
        } 
        //按數字或是運算符時顯示按到的內容  
        
        if(e.target.className === 'btn equal' ){
            if(result.innerText.includes('+')){
                arr = result.innerText.split('+')
                result.innerText = parseInt(arr[0],10) + parseInt(arr[1],10)
            } else if(result.innerText.includes('-')) {
                arr = result.innerText.split('-')
                result.innerText = arr[0] - arr[1];
            } else if(result.innerText.includes('x')) {
                arr = result.innerText.split('x')
                result.innerText = arr[0] * arr[1]
            } else if(result.innerText.includes('÷')) {
                arr = result.innerText.split('÷')
                result.innerText = arr[0] / arr[1]
            } 
        }
        //按"="時顯示結果（只能運算兩數）

    })
})
