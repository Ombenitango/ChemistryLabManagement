<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:../index.php");
}else{
$user=$_SESSION['username'][0];
}
$t=time();
$time= date("Y/m/d"); 
$timeHr=date("Y/m/d",$t);
include('../connection.php');
//update items,but we need to select first
if(isset($_POST['submit-update'])){
    $ItemName=$_GET['viewId'];
    $i_updatename=$_POST['itemname'];
    $i_updatecategory=$_POST['category'];
    $i_serial=$_POST['serial'];
    $i_expiredate=$_POST['expire'];
    $i_updatephoto=$_FILES['file']['name'];
    $i_updatetmp_Photo_name=$_FILES['file']['tmp_name'];
    $i_updateprice=$_POST['price-of-item'];
    $i_updatestatus=$_POST['item-status'];
    $i_updatedescription=$_POST['itemsDecsctrion'];
    $i_updatequantity=$_POST['quantity'];
    //selectin item and stored in itemHistory before update
    $updatequary="UPDATE items SET i_name='$i_updatename',i_serial_no='$i_serial',i_expire_date='$i_expiredate',i_category='$i_updatecategory',i_quantity='$i_updatequantity',i_description=' $i_updatedescription',i_images='$i_updatephoto',i_price='$i_updateprice',i_status='$i_updatestatus',i_time_added='$time',whoUpdate='$user' WHERE i_name='$ItemName'";
    $queryUpdate=mysqli_query($connection,$updatequary);
    if($queryUpdate)
    {
      move_uploaded_file($i_updatetmp_Photo_name,"../itemPhoto/".$i_updatephoto);

    }else 
    {
      echo "error".mysqli_error($connection);
    }
  }
?>

<?php 
$user=$_SESSION['username'][0];
if(isset($_POST['submit-update-edit'])){
    $ItemName=$_GET['viewId'];
    $i_updatename=$_POST['itemname'];
    $i_updatequantity=$_POST['quantity'];
    $selectItems="SELECT*FROM items  WHERE i_name='$ItemName'";

   
    // include("../connection.php");
    // $selectItems="SELECT*FROM items WHERE i_expire_date<='$dateExpire'";
    
    $resultOfselectedItems=mysqli_query($connection,$selectItems);
    if($rowOfresualt=mysqli_fetch_array($resultOfselectedItems)){
        $id=$rowOfresualt[0];
        $i_nameH=$rowOfresualt[3];
        $i_quantityH=$rowOfresualt[5];
        $i_timeH=$rowOfresualt[10];
        $i_serialH=$rowOfresualt[1];
        $i_expire=$rowOfresualt[2];
        // update items new after 
        if($i_quantityH==0){
          header("location:../store/");
        }else{
          $expireTime=time();
          $dateExpire=date('Y-m-d',$expireTime);
          if($i_expire>=$dateExpire){
          $insertHistory="INSERT INTO itemhistory(id,i_serial_no,i_name,i_quantity,i_date)VALUES(0,'$i_serialH','$i_nameH','$i_quantityH','$i_timeH')";
          if( mysqli_query($connection,$insertHistory))
          {
           
          }else 
          {
            echo "not done ".mysqli_error($connection);
          }
          $Qu=$_GET['qu'];
          $anser=($Qu-$i_updatequantity);
          $updateStore="UPDATE items SET i_quantity='$anser',whoUpdate='$user' WHERE i_id='$id'";
          if(mysqli_query($connection, $updateStore)){
           
          }else{
            echo "Error:".mysqli_error($connection);
          }
          }else {
            echo "<script>alert('Items already expired');</script>";
            
          }
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
    <link rel="stylesheet" href="views.css">
    <link rel="stylesheet" href="../store/store.css">
    <link rel="stylesheet" href="../mystyle/font.css">
</head>
<body>
<div class="containerbody">
    <div class="navigationBar">
    <h1 id="chemistry-logohome"> <img src="../icons/menu_64px.png" alt="" srcset="" width="35px" height="35px" id="displaymenus"><span id="clmsdis">CHEMISTRY LABORATORY MANAGEMENT SYSTEM </span><span id="scmsshow">CLMS</span></h1></h1>
     <!-- <div class="iconTopNavigation">
         <img src="../icons/appointment_reminders_40px.png" alt="" srcset="" width="30px" height="30px" class="toicons">
         <img src="../icons/circled_user_male_48px.png" alt="" srcset="" width="30px" height="30px" class="toicons" id="prifile-icons">
     </div> -->
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
        
        <div class="update">
       <div class="formo1">
            <div id="addtitle"><h4>Enter quantity used</h4></div>
           <form action="" method="post" id="formitemadd" enctype="multipart/form-data">
            <input type="text" name="itemname" id="itemnameid" placeholder=" Item name" class="itemIputs" required value="<?php echo $_GET['viewId'];?>"><br>
            <input type="number" min ="1" name="quantity" id="quantity" placeholder="Quantity" class="itemIputs" required>
             <button type="submit" style="background-color: lightgreen;" class="add-cancelbtn" name="submit-update-edit" id="addbtn">USE
          </button>
          </form>
          <button style="background-color: red;" class="add-cancelbtn" id="cancelbnt-update">CANCEL</button>
          </div>
         </div>
         <div class="update" style="overflow-y: scroll;" id="updateformitems">
         <div class="formo1">
            <div id="addtitle"><h4>Update item</h4></div>
           <form action="" method="post" id="formitemadd" enctype="multipart/form-data">
            <input type="text" name="itemname" id="itemnameid" placeholder="" class="itemIputs" required value="<?php echo $_GET['viewId'];?>""><br>
            <input type="text" name="category" id="category" placeholder="Category" class="itemIputs" required  value="<?php echo $_GET['catId'];?>""><br>
            <input type="number" min="1" name="quantity" id="quantity" placeholder="Quantity" class="itemIputs" required value="<?php echo $_GET['qu'];?>">
            <input type="text" name="serial" id="quantity" placeholder="Serial No" class="itemIputs" required value="<?php echo $_GET['serialId'];?>">
            <input type="text"  name="expire" id="quantity" placeholder="Expire date:Eg 2020/01/28" class="itemIputs" required value="<?php echo $_GET['expId'];?>">
            <textarea name="itemsDecsctrion" id="" cols="30" rows="10" placeholder="Description" class="itemIputsDes" required><?php echo $_GET['decId'];?></textarea><br>
            <input type="file" name="file" id="" class="itemIputs" required><br>
            <input type="number" min ="1000" name="price-of-item" id="itemprice" placeholder="Price" class="itemIputs" required value="<?php echo $_GET['priceId'];?>"><br>
            <!-- <input type="text" name="item-status" id="item-statussview" placeholder="Status" class="itemIputs" required value=""> -->
            <select name="item-status" id="item-statussview" class="itemIputs">
            <option value="status" selected disabled>Choose status</option>
            <option value="New">New</option>
            <option value="Old">Old</option>
            </select>
             <button type="submit" style="background-color: lightgreen;" class="add-cancelbtn" name="submit-update" id="addbtn">UPDATE
          </button>
          </form>
          <button style="background-color: red;" class="add-cancelbtn" id="cancelbnt-update-next">CANCEL</button>
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
             <button id="edit-btn" class="edit-btn-now">USE ITEM</button>
             <button id="edit-btn-next" class="edit-btn-now">UPDATE ITEM</button>
           </div>

           <div class="itemDisplay">
           <?php 
         
         if(isset($_GET['viewId'])){
         unset($_POST['submit-update']);
         $ItemName=$_GET['viewId'];
         include("../connection.php");
         $selectItems="SELECT*FROM items WHERE i_name='$ItemName'";
         $resultOfselectedItems=mysqli_query($connection,$selectItems);
         if($rowOfresualt=mysqli_fetch_array($resultOfselectedItems)){
           $i_name=$rowOfresualt[3];
           $i_category=$rowOfresualt[4];
           $i_quantity=$rowOfresualt[5];
           $i_description=$rowOfresualt[6];
           $i_images=$rowOfresualt[7];
           $i_price=$rowOfresualt[8];
           $i_status=$rowOfresualt[9];
           $unit=$rowOfresualt[13];
           ?>
           <div class="tabledispla">
            <div id="column-one" class="table-sub-update">
               <img src="../itemPhoto/<?php echo  $i_images; ?>"alt="" srcset="" width="300px" height="300px">
               
            </div>
               <div class="otheritems">
               <div id="column-two" class="table-sub-update">
               <strong>Name: </strong>
               <strong>Category</strong>
               <strong>Quatintity</strong>
               <strong>Decription</strong>
               <strong>Price</strong>
               <strong>Status</strong>
               </div>
               <div id="column-three" class="table-sub-update">
               <div><?php echo $i_name;?></div>
               <div><?php echo $i_category;?></div>
               <div><?php echo $_GET['qu']." ".$unit;?></div>
               <div><?php echo $i_description;?></div>
               <div><?php echo $i_price;?></div>
               <div><?php echo $i_status;?></div>
               </div>
                <?php 
            }
        
         }
          ?>


          <?php 
     
          
         if(isset($_POST['submit-update'])){
            
            $i_updatename=$_POST['itemname'];
            $selectItems="SELECT*FROM items WHERE i_name='$i_updatename'";
            $resultOfselectedItems=mysqli_query($connection,$selectItems);
            if($rowOfresualt=mysqli_fetch_array($resultOfselectedItems)){
              $i_name=$rowOfresualt[1];
              $i_category=$rowOfresualt[2];
              $i_quantity=$rowOfresualt[3];
              $i_description=$rowOfresualt[4];
              $i_images=$rowOfresualt[5];
              $i_price=$rowOfresualt[6];
              $i_status=$rowOfresualt[7];

              ?>
              <div class="tabledispla">
               <div id="column-one" class="table-sub-update">
                  <img src="../itemPhoto/<?php echo  $i_images; ?>"alt="" srcset="" width="50%" height="50%">
                  
               </div>
                  <div class="otheritems">
                  <div id="column-two" class="table-sub-update">
                  <strong>Name</strong>
                  <strong>Category</strong>
                  <strong>Quatintity</strong>
                  <strong>Decription</strong>
                  <strong>Price</strong>
                  <strong>Status</strong>
                  </div>
                  <div id="column-three" class="table-sub-update">
                  <div><?php echo $i_name;?></div>
                  <div><?php echo $i_category;?></div>
                  <div><?php echo  $i_quantity;?></div>
                  <div><?php echo $i_description;?></div>
                  <div><?php echo $i_price;?></div>
                  <div><?php echo $i_status;?></div>
                  </div>
                   <?php 
            }

           }else{
             
            }
          
          
          
          ?>
           </div>
        </div>
    </div>
</div>
<script src="../myscript/home.js"></script>
<script>
    var Allupdate= document.querySelector('#edit-btn').addEventListener('click',function(){
        document.querySelector('.update').style.display="block";
        
    });
  
document.querySelector('#cancelbnt-update').addEventListener('click',function(){
    document.querySelector('.update').style.display="none";

})


document.querySelector('#edit-btn-next').addEventListener('click',function(){
   
        document.querySelector('#updateformitems').style.display="block";
        
    });
  
document.querySelector('#cancelbnt-update-next').addEventListener('click',function(){
    document.querySelector('#updateformitems').style.display="none";

})

</script>

</body>
</html>
<?php include("../footer/footer.php"); ?>