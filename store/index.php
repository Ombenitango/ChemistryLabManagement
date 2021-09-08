<?php 
$t=time();
$time= date("Y/m/d:i:s",$t);
include('../connection.php');
session_start();
if(!isset($_SESSION['username'])){
  header("location:../index.php");
}else {
  $user=$_SESSION['username'][0];
 if(isset($_POST['submit'])){
  $i_name=$_POST['itemname'];
  $i_category=$_POST['category'];
  $i_serial=$_POST['serial'];
  $i_expiredate=$_POST['expire'];
  $i_photo=$_FILES['file']['name'];
  $i_tmp_Photo_name=$_FILES['file']['tmp_name'];
  $i_price=$_POST['price-of-item'];
  $i_status=$_POST['item-status'];
  $i_description=$_POST['itemsDecsctrion'];
  $i_quantity=$_POST['quantity'];
  $unit=$_POST['unit'];
  $time=time();
  $timeHr=date("Y/m/d");
  
  $insertData="INSERT INTO items(i_id,i_serial_no,i_expire_date,i_name,i_category,i_quantity,i_description,i_images,i_price,i_status,i_time_added,whoAddItem,whoUpdate,unit)VALUES(0,'$i_serial','$i_expiredate',' $i_name','$i_category','$i_quantity','$i_description','$i_photo','$i_price','$i_status','$timeHr','$user','','$unit')";

  $check_if_exit="SELECT * FROM `items` WHERE i_name=' $i_name'";

  $re=mysqli_query($connection,$check_if_exit);
  if($rows=mysqli_fetch_array($re)){
       $id=$rows[0];
       $i_quantitys=$rows[5];
       $updatequatity=$i_quantitys+$i_quantity;
       $update="UPDATE items SET i_quantity='$updatequatity' WHERE i_id='$id'";
       mysqli_query($connection,$update);
  }else {
    $excuteinsertData=mysqli_query($connection,$insertData);
    if($excuteinsertData){
      move_uploaded_file($i_tmp_Photo_name,"../itemPhoto/".$i_photo);
    }else {
      echo "Error".mysqli_error($connection);
    }
  }
 }
}
//deleting item 
if(isset($_GET['deleteId'])){
$ItemName=$_GET['deleteId'];
$selectId="SELECT*FROM items WHERE i_name='$ItemName'";
$selectIdResult=mysqli_query($connection,$selectId);
while($rowId=mysqli_fetch_array($selectIdResult)){
  $id=$rowId[0];
}
$delete="DELETE FROM items WHERE i_name='$ItemName'AND i_id='$id'";
$deleteExcute=mysqli_query($connection,$delete);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../home/home.css">
    <link rel="stylesheet" href="store.css">
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

     <div class="formAdditem" style=" overflow-y: scroll;">
       <div class="formo1">
            <div id="addtitle"><h4>Add item</h4></div>
           <form action="?" method="post" id="formitemadd" enctype="multipart/form-data">
            <input type="text" name="itemname" id="itemnameid" placeholder=" Item name" class="itemIputs" required"><br>
            <input type="text" name="category" id="category" placeholder="Category" class="itemIputs" required "><br>
            <div id="displaysapan">
            <input type="number" min="1" name="quantity" id="quantity" placeholder="Quantity" class="itemIputs quat" required>
            <select name="unit" id="unitselect">
            <option value=""></option>
              <option value="Kg">Kg</option>
              <option value="Ltr">liter</option>
              <option value="Gr">Grm</option>
            </select>
            </div>
            <input type="text" name="serial" id="quantity" placeholder="Serial No" class="itemIputs" required>
            <input type="date" name="expire" id="quantity" placeholder="Expire date:Eg 2020/01/28" class="itemIputs" required>
            <textarea name="itemsDecsctrion" id="" cols="30" rows="10" placeholder="Description" class="itemIputsDes" required pattern="[a-zA-Z0-9]+"></textarea><br>
            <input type="file" name="file" id="" class="itemIputs" required><br>
            <input type="number" min="1000" name="price-of-item" id="itemprice" placeholder="Price" class="itemIputs" required><br>
            <!-- <input type="text" name="item-status" id="item-statussview" placeholder="Status" class="itemIputs" required> -->
            <select name="item-status" id="item-statussview" class="itemIputs" required>
            <option value="status" selected disabled>Choose status</option>
            <option value="New">New </option>
            <option value="Old">Old</option>
            </select>
           <button type="submit" style="background-color: green;" class="add-cancelbtn" name="submit" id="addbtn">ADD
            </button>
        </form>
        <button style="background-color: red;" class="add-cancelbtn" id="cancelbnt">CANCEL</button>
       </div>
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
          <div class="centerDiv-subnav">
            
             <button id="additmes"> <img src="../icons/plus_24px.png" alt="" srcset="" width="20px" height="20px"> Add items</button>
          </div>
         <h1 style="text-align: center;" id="itmes">Items presents</h1><hr>
         <?php 
          $expireTime=time();
          $dateExpire=date('Y-m-d',$expireTime);
         include("../connection.php");
         $selectItems="SELECT * FROM  items WHERE i_expire_date>='$dateExpire' ORDER BY `items`.`i_id` DESC";
         $resultOfselectedItems=mysqli_query($connection,$selectItems);
         while($rowOfresualt=mysqli_fetch_array($resultOfselectedItems)){
           $i_name=$rowOfresualt[3];
           $i_category=$rowOfresualt[4];
           $i_quantity=$rowOfresualt[5];
           $i_description=$rowOfresualt[6];
           $i_images=$rowOfresualt[7];
           $i_price=$rowOfresualt[8];
           $i_status=$rowOfresualt[9];
           $i_serialNo=$rowOfresualt[1];
           $i_expiredateNo=$rowOfresualt[2];
           $unit=$rowOfresualt[13];
          ?>
           <div class="tablediplay">
           <div id="column-one" class="table-sub">
           <strong>Image</strong>
           <img src="../itemPhoto/<?php echo  $i_images; ?>" alt="" srcset="" width="100%" height="200px">
           </div>
           <div id="column-two" class="table-sub">
          <strong>Name</strong>
          <div><?php echo $i_name;?></div>
           </div>
           <div id="column-three" class="table-sub">
             <strong>Category</strong>
             <div><?php echo $i_category;?></div>
           </div>
           <div id="column-four" class="table-sub">
             <strong>Quatintity</strong>
             <div id="remaging"><?php 
              if($i_quantity<0){
                 $i_quantity=0;
                 echo $i_quantity." ". $unit;
              }else {
                echo $i_quantity." ". $unit;
              }
           
             ?></div>
           </div>
           <div id="column-five" class="table-sub">
             <strong>Decription</strong>
             <div><?php echo $i_description;?></div>
           </div>
           <div id="column-six" class="table-sub">
             <strong>Price</strong>
             <div><?php echo $i_price;?></div>
           </div>
           <div id="column-seven" class="table-sub">
             <strong>Status</strong>
             <div><?php echo $i_status;?></div>
           </div>
           <div id="column-eight" class="table-sub">
           <strong>Action</strong><br>
          <a href="index.php?deleteId=<?php echo $i_name;?>"> <button  class="update-deletebtn">DELETE</button></a>
          <a href="../views/index.php?viewId=<?php echo $i_name;?>&qu=<?php echo $i_quantity;?>&catId=<?php echo $i_category;?>&decId=<?php echo  $i_description;?>&priceId=<?php echo $i_price;?>&statId=<?php echo $i_status;?>&serialId=<?php echo $i_serialNo;?>&expId=<?php echo $i_expiredateNo;?>"><button class="update-deletebtn">View More</button></a>
           </div>
           </div>
           <?php 
         }
         ?>
        </div>
    </div>
</div>
<script src="../myscript/jQuerrylibarary.js"></script>
<script src="../myscript/home.js"></script>
<script src="../myscript/store.js"></script>
<script src="../myscript/users.js"></script>
<script>
$(document).ready(function(){
            function fetchdata(){
                    $.ajax({
                        url:"checkingdb.php",
                        method:"POST",
                        data:{key:"done"},
                        cashe:false,
                        success:function(datamess){
                            console.log(datamess);
                        }
                    })
                } 
            setInterval(function(){
                
            },2000);

            fetchdata();
        });

        
</script>
</body>
</html>
