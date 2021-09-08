<?php 
session_start();
if(!isset($_SESSION['username'])){
  header("location:../index.php");
}else {
    $user=$_SESSION['username'][0];
    $passwrod=$_SESSION['username'][1];
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="../mystyle/font.css">
   
</head>
<body>
<div class="containerbody">
    <div class="navigationBar">
    <h1 id="chemistry-logohome"> <img src="../icons/menu_64px.png" alt="" srcset="" width="35px" height="35px" id="displaymenus"><span id="clmsdis"> CHEMISTRY LABORATORY MANAGEMENT SYSTEM </span><span id="scmsshow">CLMS</span></h1></h1>
     <div class="iconTopNavigation">
         <!-- <img src="../icons/appointment_reminders_40px.png" alt="" srcset="" width="30px" height="30px" class="toicons" id="notificationsss">
         <div class="toicons"><img src="../icons/circled_user_male_48px.png" alt="" srcset="" width="30px" height="30px" class="toicons" id="prifile-icons"></div> -->
     </div>
    </div>
    <div class="wholecontainer"> 
        <div class="leftDiv">
        <div class="leftdiv-sub">
        <div class="Store"> <img src="../icons/speed_32px.png" alt="" srcset="" width="30px" height="30px" class="imgaeslink"> <a href="../home/?user=<?php echo $_SESSION['username'][0];?>" class="links-all">Dashboard</a></div>
        <div class="Store"> <img src="../icons/windows_phone_store_30px.png" alt="" srcset="" width="30px" height="30px" class="imgaeslink"> <a href="../store/?user=<?php echo $_SESSION['username'][0];?>" class="links-all">Store</a></div>
         <div class="usage"> <img src="../icons/chemical_storage_tank_filled_50px.png" alt="" srcset="" width="25px" height="25px" class="imgaeslink"><a href="../usage/?usage/user=<?php echo $_SESSION['username'][0];?>" class="links-all">Usage</a></div>
         <div class="expired"> <img src="../icons/expired_24px.png" alt="" srcset="" class="imgaeslink"><a href="../expired/?user=<?php echo $_SESSION['username'][0];?>" class="links-all">Inventory</a></div>
        </div>
        <div class="expired"> <img src="../icons/user_male_30px.png" alt="" srcset="" class="imgaeslink"><a href="../users/?user=<?php echo $_SESSION['username'][0];?>" class="links-all">Users</a></div>
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
             }

             ?>
             <a href="../logout.php">Logout</a>
             <?
            }else{
                $usename=$_SESSION['username'][0];
                $usersSelection="SELECT*FROM users WHERE username='$usename'";
                $excuteQuery=mysqli_query($connection,$usersSelection);
                while($row=mysqli_fetch_array($excuteQuery)){
                    $name01=$row[2];
                    
                }
                ?>
                 <a href="../logout.php">Logout</a>
                <?
            }

           
         ?></span>

              </div>
        
        <div class="cale">
        <h3 style="text-align: center;">Calendar</h3>
         <p style="background-color: red;"><?php include("./demo.html");?></p>
        </div>
        <h4 style="text-align: center;">Last activities</h4>
        <div class="griDKubwa">
                          <strong class="absc">Description</strong>
                          <strong class="absc">Quantitiy</strong >
                          <strong class="absc">Date</strong>
                          <strong class="absc">Username</strong>
                        
                        </div>
        <div class="subonelastactivity">
            
            <?php 
            $user=$_SESSION['username'][0];
            $passwrod=$_SESSION['username'][1];
            include("../connection.php");
            $selectingUser=mysqli_query($connection,"SELECT*FROM users WHERE username='$user'AND password='$passwrod'");
            if($selectingUser){
               while($row01=mysqli_fetch_array($selectingUser)){
                   $nameUser=$row01[1];
                   $lastamer=$row01[2];
                   $passwrodUser=$row01[3];
                   $selectAdded=mysqli_query($connection,"SELECT*FROM items WHERE whoAddItem='$lastamer'");
                   while($row02=mysqli_fetch_array($selectAdded)){
                    $itmename=$row02[3];
                    $Quantitiy=$row02[5];
                    $dateAdded=$row02[10];
                    $itmeinamge=$row02[7];
                       ?>
                        
                       <div class="grid">
                           <div class="grid-sub"><?php echo "Add new item"." ".$itmename;?></div>
                           <div class="grid-sub"><?php echo $Quantitiy;?></div>
                           <div class="grid-sub"><?php echo $dateAdded;?></div>
                           <div class="grid-sub"><?php echo $lastamer;?></div>
                          
                       </div>
                       <?php 
                   }
               }
            }else {
                echo "error".mysqli_error($connection);
            }
            
            
            ?>

            <?php 
            
            $user=$_SESSION['username'][0];
            $passwrod=$_SESSION['username'][1];
            include("../connection.php");
            $selectingUser=mysqli_query($connection,"SELECT*FROM users WHERE username='$user'AND password='$passwrod'");
            if($selectingUser){
               while($row01=mysqli_fetch_array($selectingUser)){
                   $nameUser=$row01[1];
                   $lastamer=$row01[2];
                   $passwrodUser=$row01[3];
                   $selectAdded=mysqli_query($connection,"SELECT*FROM items WHERE whoAddItem='$lastamer'");
                   while($row02=mysqli_fetch_array($selectAdded)){
                       $itmename=$row02[3];
                       $Quantitiy=$row02[5];
                       $dateAdded=$row02[10];
                       $itmeinamge=$row02[7];
                       ?>
                       <div class="grid">
                           <div class="grid-sub"><?php echo "Upadate"." ".$itmename;?></div>
                           <div class="grid-sub"><?php echo $Quantitiy;?></div>
                           <div class="grid-sub"><?php echo $dateAdded;?></div>
                           <div class="grid-sub"><?php echo $lastamer;?></div>
                          
                       </div>
                       <?php 
                   }
               }
            }else {
                echo "error".mysqli_error($connection);
            }
            
            ?>
        </div>
        </div>
    </div>
</div>
<script src="../myscript/home.js"></script>
<script src="../myscript/users.js"></script>

</body>
</html>

 