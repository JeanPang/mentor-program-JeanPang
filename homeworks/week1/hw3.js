export const isPrime = (n) => {
    if (!Number.isInteger(n))
    {
        return false;
    };
    //測試是否為整數
  
    if (n<2){
        return false;
    };
    //測試是否小於2
  
    if (n===2){
        return true;
    }
    else if (n%2===0){
        return false;
    };
    //測試是否能被2整除
  
    for(let i=2; i<(n-1); i++){
      if (n%i===0){
            return false;
        }
    }
  
  return true
  }
    
  //console.log (isPrime(3)) //test