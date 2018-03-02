document.addEventListener( 'DOMContentLoaded', () => {
  document.querySelector('form').addEventListener('submit',e => {
    var ans1 = document.querySelector('form > div:nth-child(1) > input').value
    var ans2 = document.querySelector('form > div:nth-child(2) > input').value
    var ans3 = ''
    var ans4 = document.querySelector('form > div:nth-child(4) > input').value

    var choice = document.querySelectorAll('[name=choice]')
    if(choice[0].checked) {
      ans3 = choice[0].value
    } else if (choice[1].checked) {
      ans3 = choice[1].value
    }  

    var warn1 = document.querySelector('.question:nth-child(1)>.reminder')
    var warn2 = document.querySelector('.question:nth-child(2)>.reminder')
    var warn3 = document.querySelector('.question:nth-child(3)>.reminder')
    var warn4 = document.querySelector('.question:nth-child(4)>.reminder')

    if(!ans1||!ans2||!ans3||!ans4){
      if(!ans1) {showWarning(warn1)}
      else {hideWarning(warn1)}
      if(!ans2) {showWarning(warn2)}	
      else {hideWarning(warn2)}
      if(!ans3) {showWarning(warn3)}
      else {hideWarning(warn3)}
      if(!ans4) {showWarning(warn4)}
      else {hideWarning(warn4)}
      e.preventDefault();
    } else {
      console.log('【已填寫】');
      console.log('電子郵件地址：' + ans1);
      console.log('暱稱：' + ans2);
      console.log('報名類型：' + ans3);
      console.log('程式相關背景：' + ans4);
      alert('已送出表單！');
      //return true
		}
    
    function showWarning(w) {
      w.parentNode.style.backgroundColor = '#fcecee'
      w.style.color = 'red'
      //w.classList.remove('.hidden')
    }

      function hideWarning(w) {
      w.parentNode.style.backgroundColor = '#ffffff'
      w.style.color = 'white'
      //w.classList.add('.hidden')
      //不知為何用不到hiddenQQ
    }
  })
})
