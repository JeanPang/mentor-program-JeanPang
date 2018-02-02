export const isPrime = (n) => {
  if (!Number.isInteger(n))
  {
      return false;
  };

  if (n<2){
      return false;
  };

  if (n===2){
      return true;
  }
  else if (n%2===0){
      return false;
  };

  if (n===[3,5,7,9]){
      for(i=3; i<11; i+2){
          if (n%i===0){
              return false;}
          else 
              return true;
          }; 
      };
  return true;
  };

console.log (isPrime(98))