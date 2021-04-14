<?php  
session_start();
if(!isset($_SESSION['username'])){
    header("location:../index.php");
}else{

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../home/home.css">
</head>
<body>
<div class="containerbody">
    <div class="navigationBar">
    <h1 id="chemistry-logohome">CHEMISTRY LABORATORY MANAGEMENT SYSTEM</h1>
     <div class="iconTopNavigation">
         <img src="../icons/appointment_reminders_40px.png" alt="" srcset="" width="30px" height="30px" class="toicons">
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
        </div>
    </div>
</div>
<script src="../myscript/home.js"></script>
</body>
</html>
<?php include("../footer/footer.php"); ?>