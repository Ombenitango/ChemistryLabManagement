<?php 
session_start();
 include("connection.php");
if(isset($_POST['submit'])){
  $username=$_POST['username'];
  $password=$_POST['password'];
  $select="SELECT*FROM users WHERE username='$username'AND password='$password'";
  $resualtSelect=mysqli_query($connection,$select);
  if(mysqli_num_rows($resualtSelect)==0){
    ?>
    <div class="errormessage">
       <strong class="Register">Not Registered</strong>
       <strong class="Registerw">Cancel</strong>
    </div>
    <?
  }else {
    header("location:home/");  
    $_SESSION['username']=array($username,$password);
    
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>clms</title>
    <link rel="stylesheet" href="./mystyle/index.css">
    <style>
    .errormessage{
      background-color:red;
      width:50%;
      height:50px;
      display:flex;
      flex-direction:row;
      justify-content:center;
      align-items:center;
      font-weight:blod;
      transform: translate3d(20rem,10rem,0rem);
      
    }
   .Register{
      flex:5;
      display:flex;
      flex-direction:row;
      justify-content:center;
      align-items:center;
      font-weight:blod;
   }
   .Registerw{
      flex:1;
      cursor: pointer;
      display:flex;
      flex-direction:row;
      justify-content:center;
      align-items:center;
      font-weight:blod;
}
    </style>
</head>
<body>
  <div class="container">
    <?php include("./header/header.php"); ?>
  <div class="loginForm">
  <h4>Login</h4>
  <fieldset id="fleidset">
  <form action="" method="post">
   <input type="text" name="username" id="username" placeholder="username"><br>
   <input type="password" name="password" id="password" placeholder="password"><br>
    <button type="submit" id="submitbtn" name="submit">Login</button>
  </form>
  </fieldset>
  </div>
  </div>
  <script>
  document.querySelector(".Registerw").addEventListener("click",()=>{
    document.querySelector(".errormessage").style.display="none";
  })
  </script>
</body>
</html>
