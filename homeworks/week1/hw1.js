export const stars = (n) => {
  let x =[]
  let output=[]
  for (let i = 1; i <= n; ++i){
      output += '*' 
      x.push(output);
  }
  return (x)
}

//stars(3) //test