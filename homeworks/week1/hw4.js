export const isPalindromes = (str) => {
  const array = str.split('')
  //console.log(array)
  //結果為Array(7) ["a", "b", "c", "d", "c", "b", "a"]

  const arr = new Array()
  for (let i=0; i<(array.length/2); i++){
    //當第一個字等於最後一個字，第二個字等於最後第二個字，以此類推
    if (array[i]==array[(array.length-1)-i]){ 
        arr.push("1") //1為true
    }
    else{
        arr.push("2") //2為false
    }
  };
  //console.log(arr)
  //印出是否個別相等的結果

  const stringfalse = (element, index, array) => {
    return (element <2); //測試是否全部結果為true(1,小於2)
  }
  return (arr.every(stringfalse)); //測試通過則傳回true
}

//isPalindromes('0987654321234567890') //test

