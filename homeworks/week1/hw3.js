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


    if ((n===3)|(n===5)|(n===7)){       
        return true
    }
    //3,5,7為質數

    for(let i=3; i<9; i+2){
    //篩法：測試是否能被3,5,7整除
        if (n%i===0){
            return false;
        }
        else {
            return true;
        }
    }
    
};
    
//console.log (isPrime(317)) //test
