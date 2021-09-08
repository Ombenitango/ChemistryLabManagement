<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:../index.php");
}else{

}?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../home/home.css">
    <link rel="stylesheet" href="expire.css">
    <link rel="stylesheet" href="../mystyle/font.css">
</head>
<body>
<div class="containerbody">
    <div class="navigationBar">
    <h1 id="chemistry-logohome"> <img src="../icons/menu_64px.png" alt="" srcset="" width="35px" height="35px" id="displaymenus"><span id="clmsdis">CHEMISTRY LABORATORY MANAGEMENT SYSTEM </span><span id="scmsshow">CLMS</span></h1></h1>
     <div class="iconTopNavigation">
         <!-- <img src="../icons/appointment_reminders_40px.png" alt="" srcset="" width="30px" height="30px" class="toicons">
         <img src="../icons/circled_user_male_48px.png" alt="" srcset="" width="30px" height="30px" class="toicons" id="prifile-icons"> -->
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
              <button style="width:100px; height:30px" class="edit-btn" id="newbtn">New</button>
             <button style="width:100px; height:30px" class="edit-btn" id="oldbtn">Old</button>
             <button style="width:100px; height:30px" class="edit-btn" id="exbtn">Expired</button>
              </div>
           </div>
         
           <div class="New">
            <?php 
            $time=time();
            $t=date('Y-m-d',$time);
             include('../connection.php');
             $selectNew="SELECT*FROM items WHERE i_status='new'AND i_expire_date>='$t'";
             $resualt=mysqli_query($connection,$selectNew);
             if(mysqli_num_rows($resualt)==0){
              echo "No new items found";
              }else{
                while($rowNew=mysqli_fetch_array($resualt)){
                  $i_name=$rowNew[3];
                  $i_category=$rowNew[4];
                  $i_quantity=$rowNew[5];
                  $i_description=$rowNew[6];
                  $i_images=$rowNew[7];
                  $i_price=$rowNew[8];
                  $serialNo=$rowNew[1];
                  $exprie=$rowNew[2];
                   ?>
                   <div class="table">
                     <div class="tables-sumb"><img src="../itemPhoto/<?php echo  $i_images; ?>" alt="" srcset="" width="100%" height="200px"></div>
                     <div class="tables-sumb" > <strong>Name:</strong><?php echo $i_name;?></div>
                     <div class="tables-sumb" > <strong>Serial no:</strong><?php echo $serialNo; ?></div>
                     <div class="tables-sumb" > <strong>Category:</strong><?php  echo $i_category;?></div>
                     <div class="tables-sumb" > <strong>Quanitity:</strong> <?php  echo $i_quantity;?></div>
                     <div class="tables-sumb" > <strong>Price</strong><?php echo $i_price;?></div>
                     <div class="tables-sumb"> <strong>Expire date:</strong><?php echo $exprie;?></div>
                   </div>
                   <?php 
                 }
              }
            
            
            ?>
           </div>
           <div class="Old">
           <?php 
            $time=time();
            $t=date('Y-m-d',$time);
             include('../connection.php');
             $selectNew="SELECT*FROM items WHERE i_status='old'AND i_expire_date>='$t' ";
             $resualt=mysqli_query($connection,$selectNew);
             if(mysqli_num_rows($resualt)==0){
                    echo "No old items found";
             }else{

              while($rowNew=mysqli_fetch_array($resualt)){
                $i_name=$rowNew[3];
                $i_category=$rowNew[4];
                $i_quantity=$rowNew[5];
                $i_description=$rowNew[6];
                $i_images=$rowNew[7];
                $i_price=$rowNew[8];
                $serialNo=$rowNew[1];
                $exprie=$rowNew[2];
                 ?>
                 <div class="table">
                   <div class="tables-sumb"><img src="../itemPhoto/<?php echo  $i_images; ?>" alt="" srcset="" width="100%" height="200px"></div>
                   <div class="tables-sumb" > <strong>Name:</strong><?php echo $i_name;?></div>
                   <div class="tables-sumb" > <strong>Serial no:</strong><?php echo $serialNo; ?></div>
                   <div class="tables-sumb" > <strong>Category:</strong><?php  echo $i_category;?></div>
                   <div class="tables-sumb" > <strong>Quanitity:</strong> <?php  echo $i_quantity;?></div>
                   <div class="tables-sumb" > <strong>Price</strong><?php echo $i_price;?></div>
                   <div class="tables-sumb"> <strong>Expire date:</strong><?php echo $exprie;?></div>
                 </div>
                 <?php 
               }
              
             }
             
            ?>

           </div>
           <div class="Expired">

           <?php 
         $expireTime=time();
         $dateExpire=date('Y-m-d',$expireTime);
         include("../connection.php");
         $selectItems="SELECT*FROM expire";
         $resultOfselectedItems=mysqli_query($connection,$selectItems);
         while($rowOfresualt=mysqli_fetch_array($resultOfselectedItems)){
          $i_name=$rowOfresualt[1];
          $i_category=$rowOfresualt[3];
          $i_quantity=$rowOfresualt[4];
          $i_description=$rowOfresualt[6];
          $i_price=$rowOfresualt[5];
          $serialNo=$rowOfresualt[6];
          $exprie=$rowOfresualt[2];
          ?>
                 <div class="table">
                   <div class="tables-sumb"><img src="../itemPhoto/<?php echo  $i_images; ?>" alt="" srcset="" width="100%" height="200px"></div>
                   <div class="tables-sumb" > <strong>Name:</strong><?php echo $i_name;?></div>
                   <div class="tables-sumb" > <strong>Serial no:</strong><?php echo $serialNo; ?></div>
                   <div class="tables-sumb" > <strong>Category:</strong><?php  echo $i_category;?></div>
                   <div class="tables-sumb" > <strong>Quanitity:</strong> <?php  echo $i_quantity;?></div>
                   <div class="tables-sumb" > <strong>Price</strong><?php echo $i_price;?></div>
                   <div class="tables-sumb"> <strong style="color: red;">Expired</strong></div>
                 </div>
                 <?php 
         }
          ?>

            

           </div>
        </div>
    </div>
</div>
<script src="../myscript/home.js"></script>
<script src="../myscript/users.js"></script>
<script>
    document.querySelector('#newbtn').addEventListener('click',function(){
      document.querySelector('.New').style.display="block";
      document.querySelector('.Old').style.display="none";
      document.querySelector('.Expired').style.display="none";
    });
    document.querySelector('#oldbtn').addEventListener('click',function(){
      document.querySelector('.Old').style.display="block";
      document.querySelector('.Old').style.marginTop="1000px";
       document.querySelector('.New').style.display="none";
       document.querySelector('.Expired').style.display="none";
    });

    document.querySelector('#exbtn').addEventListener('click',function(){
      document.querySelector('.Expired').style.display="block";
      document.querySelector('.Expired').style.marginTop="2000px";
      document.querySelector('.New').style.display="none";
       document.querySelector('.Old').style.display="none";
    
    });
</script>
</body>
</html>
