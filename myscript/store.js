document.querySelector('#additmes').addEventListener('click',()=>{
    document.querySelector('.formAdditem').style.display="block";
    document.querySelector('.formAdditem').style.transition="1s";
  
})
document.querySelector('#cancelbnt').addEventListener('click',()=>{
    document.querySelector('.formAdditem').style.display="none";
  
})
//updateDisplay
  var Allupdate= document.querySelectorAll('#update');
  for(let i=0; i<Allupdate.length; i++){
      Allupdate[i].addEventListener('click',function(){
        document.querySelector('.update').style.display="block";
      })
  }
  


