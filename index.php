<?php 
session_start();
 include("connection.php");
if(isset($_POST['submit'])){
  $username=$_POST['username'];
  $password=$_POST['password'];
  $select="SELECT*FROM users WHERE username='$username'AND password='$password'";
  $resualtSelect=mysqli_query($connection,$select);
  if(mysqli_num_rows($resualtSelect)==0){
    echo "not registered";
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
</body>
</html>
