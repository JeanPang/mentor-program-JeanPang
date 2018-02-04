export const add = (a, b) => {
    let str1 = a.split('').reverse();  
    let str2 = b.split('').reverse();  
    //拆成陣列再倒轉
    //console.log(str1)
    //console.log(str2)

    if (str1.length > str2.length){
        str2.push('0')
        //console.log(str2)
    }
    else if (str1.length < str2.length){
        str1.push('0')
        //console.log(str1)
    }
    //較短的陣列加一個0以對齊方便運算，一樣長則跳過

    str1.push('0')
    str2.push('0')
    //console.log(str1)
    //console.log(str2)
    //兩個陣列各加多一個0，讓最後一個數有進位的空間

    let w = [];
    let y = [];
    let z = [];
    for(let i = 0; i < str1.length || i < str2.length; i++){  
        let x = (str1[i]|0) + (str2[i]|0);  
        w.push(x)
        y.push(x%10);
        z.push(parseInt(x/10));
    } 
    //console.log(w) //相加的結果
    //console.log(y) //str1和str2個別相加的個位數
    //console.log(z) //str1和str2個別相加的十位數

    for(let i=0; i<str1.length|i<str2.length;i++){
        if (z[i]!=0){
            y.splice((i+1),1,(parseInt(z[i])+parseInt(y[i+1])))
            //console.log(y) //有十位數的話就進位
        }
        if (parseInt(y[i]/10)>0){
            y.splice(i+1,1,(parseInt(y[i]/10)+y[i+1]))
            //console.log(y) //進位之後下一個還是十位數再進位
            y.splice(i,1,parseInt(y[i]%10))
            //console.log(y) //把十位數去掉
        }
    }

return ((parseInt(y.reverse().join(''))).toString()) 
//反轉回來再連在一起 //用parseInt把前面的0去掉，再用toString()轉成字串
}

//add('14214', '4626') //test



