<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:../index.php");
}else{

}
include('../connection.php');
if(isset($_POST['submitdata'])){
    $name=$_POST['name'];
    $username=$_POST['username'];
    $role=$_POST['role'];
    $password=$_POST['password'];
    $checkIfuser="SELECT*FROM users WHERE name='$name'AND password='$password'";
    if($che=mysqli_num_rows(mysqli_query($connection,$checkIfuser))<0){
    }else{
        $uaddusers="INSERT INTO users(id,name,username,password,type,status)VALUES(0,'$name','$username','$password','$role','active')";
        if(mysqli_query($connection,$uaddusers)){
           ?>
           <div class="messages">
           New user added
           <span><img src="../icons/cancel_48px.png" alt="" id="cancel" width="30px" height="30px"></span>
           <?php  mysqli_num_rows(mysqli_query($connection,$checkIfuser));?>
           </div>
        <?php
        }else{
           echo "error".mysqli_error($connection);
        }
    }
  
    
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../home/home.css">
    <link rel="stylesheet" href="users.css">
    <link rel="stylesheet" href="../mystyle/font.css">
</head>
<body>
<div class="containerbody">
    <div class="navigationBar">
    <h1 id="chemistry-logohome"> <img src="../icons/menu_64px.png" alt="" srcset="" width="35px" height="35px" id="displaymenus"><span id="clmsdis">CHEMISTRY LABORATORY MANAGEMENT SYSTEM </span><span id="scmsshow">CLMS</span></h1></h1>
     <div class="iconTopNavigation">
         <img src="../icons/appointment_reminders_40px.png" alt="" srcset="" width="30px" height="30px" id="notificationsss">
         <img src="../icons/circled_user_male_48px.png" alt="" srcset="" width="30px" height="30px" class="toicons" id="prifile-icons">
     </div>
    </div>
    <div class="wholecontainer">  
        <div class="leftDiv">
        <div class="leftdiv-sub">
        <div class="Store"> <img src="../icons/speed_32px.png" alt="" srcset="" width="30px" height="30px" class="imgaeslink"> <a href="../home/?user=<?php echo $_SESSION['username'][0];?>" class="links-all">Dashboard</a></div>
        <div class="Store"> <img src="../icons/windows_phone_store_30px.png" alt="" srcset="" width="30px" height="30px" class="imgaeslink"> <a href="../store/?user=<?php echo $_SESSION['username'][0];?>" class="links-all">Store</a></div>
         <div class="usage"> <img src="../icons/chemical_storage_tank_filled_50px.png" alt="" srcset="" width="25px" height="25px" class="imgaeslink"><a href="../usage/?user=<?php echo $_SESSION['username'][0];?>" class="links-all">Usage</a></div>
         <div class="expired"> <img src="../icons/new_product_filled_50px.png" alt="" srcset="" class="imgaeslink" width="22px" height="22px"><a href="../expired/?user=<?php echo $_SESSION['username'][0];?>" class="links-all">Inventory</a></div>
         <div class="expired"> <img src="../icons/user_male_30px.png" alt="" srcset="" class="imgaeslink"><a href="../users/?user=<?php echo $_SESSION['username'][0];?>" class="links-all">Users</a></div>
        </div>
        </div>
        </div>
        <div class="centerDiv">
            <div class="userprofile">
            <span><?php 
          include('../connection.php');
          if(isset($_GET['user'])){
             $usename=$_GET['user'];
             $usersSelection="SELECT*FROM users WHERE username='$usename'";
             $excuteQuery=mysqli_query($connection,$usersSelection);
             while($row=mysqli_fetch_array($excuteQuery)){
                 $name=$row[2];
                  echo $name;
             }
            }else{
                $usename=$_SESSION['username'][0];
                $usersSelection="SELECT*FROM users WHERE username='$usename'";
                $excuteQuery=mysqli_query($connection,$usersSelection);
                while($row=mysqli_fetch_array($excuteQuery)){
                    $name01=$row[2];
                     echo $name01;
                }
            }

           
         ?></span>
            </div>
        <div class="viewNavigation">
              <div class="holderbtn">
              <button style="width:150px; display:flex; flex-direction:row; justify-content:center; align-items:center;" class="edit-btn" id="btnAdd"><img src="../icons/plus_24px.png" alt="" srcset=""> Add user</button>
             
              </div>
           </div>
           <div class="formsAdduser">
               <form action="" method="post" id="Addfrom">
               <input type="text" name="name" class="name-of-user" placeholder="Name:" class="userForm" required><br>
                   <input type="text" name="username" class="name-of-user" placeholder="Username:" class="userForm" required><br>
                   <input type="text" name="role" class="name-of-user" placeholder="Role:" class="userForm" required><br>
                   <input type="password" name="password" class="name-of-user" placeholder="Password:" class="userForm" required><br>
                   <button type="submit" name="submitdata"placeholder="Username:" class="userFormbtn" id="addbtnuser">ADD</button>
               </form>
               <button  class="userFormbtn" id="cancelAdduser">CANCEL</button>
           </div>
                       
           <div>
           <?php 
        include('../connection.php');
         if(isset($_GET['user'])){
            $usename=$_GET['user'];
            $usersSelection="SELECT*FROM users WHERE name!='$usename'";
            $excuteQuery=mysqli_query($connection,$usersSelection);
            while($row=mysqli_fetch_array($excuteQuery)){
                $name=$row[1];
                $usernamesa=$row[2];
                $typesof=$row[4];
                ?>
                <div class="displayusers">
                    <div id="name" class="displayer"><strong>Name:</strong><?php echo $name;?></div>
                    <div id="usernameone" class="displayer"><strong>Username:</strong><?php echo $usernamesa;?></div>
                    <div id="type" class="displayer"><strong>Role:</strong><?php echo $typesof;?></div>
                    <div id="action" class="displayer">Action</div>
                </div>
                <?php  
            }
         }
        
         
        ?>
           </div>

        </div> 
      
    </div>
    
</div>
<script src="../myscript/home.js"></script>
<script src="../myscript/users.js"></script>
<script>
    document.querySelector('#btnAdd').addEventListener('click',()=>{
     document.querySelector('.formsAdduser').style.display="block";
    });

    document.querySelector('#cancelAdduser').addEventListener('click',()=>{
     document.querySelector('.formsAdduser').style.display="none";
    });

    var notfi=document.querySelector('#notificationsss');
    notfi.addEventListener("click",()=>{
      window.location.href="../notification/";
    });
    document.querySelector('#cancel').addEventListener('click',()=>{
        document.querySelector('.messages').style.display="none";
    })
</script>
</body>
</html>
