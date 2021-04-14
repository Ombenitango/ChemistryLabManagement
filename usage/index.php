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
    <link rel="stylesheet" href="usage.css">
    <link rel="stylesheet" href="../mystyle/font.css">
</head>
<body>
<div class="containerbody">
    <div class="navigationBar">
    <h1 id="chemistry-logohome"> <img src="../icons/menu_64px.png" alt="" srcset="" width="35px" height="35px" id="displaymenus"><span id="clmsdis">CHEMISTRY LABORATORY MANAGEMENT SYSTEM </span><span id="scmsshow">CLMS</span></h1></h1>
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
            <h3 style="text-align: center;">Items present</h3>
            <div class="headActionane">
            <strong  id="namecoluma">Name</strong>
            <strong>Action</strong>
            </div>
        <div class="tofetchdataTocheckAvailable">
            
             <?php 
              include('../connection.php');
              $selectinHistory="SELECT*FROM itemhistory";
              $selectingitmes=mysqli_query($connection,"SELECT*FROM items");
             while($rowItmes=mysqli_fetch_array($selectingitmes)){
                 $i_name=$rowItmes[3];
                 $i_quantity=$rowItmes[5];
                 
                 ?>
                   <div class="itemshow">
                     <p><?php echo $i_name;?></p>
                   </div>
                   <div class="itemshow">
                    <a href="../usage/?name=<?php echo $i_name;?>&user=<?php echo $_SESSION['username'][0];?>"><button>View remaing items</button></a>
                   </div>
                  <?php 
             }
          
             ?>
        </div>
         <canvas id="myChart"></canvas>
         
         <?php 
           include("../connection.php");
            if(isset($_GET['name'])){
                $itmenamew=$_GET['name'];
                 $slectiFromeitmes="SELECT i_quantity FROM items WHERE i_name='$itmenamew'";
                 $selectFertQuatity=mysqli_query($connection,$slectiFromeitmes);
                $row01=mysqli_fetch_assoc($selectFertQuatity);
                $quantityfromitems=$row01['i_quantity'];
                ?>
           <div id="displaydate">
           <span id="imagescancle"><img src="../icons/cancel_48px.png" alt="" srcset="" width="30px" height="30px
         "></span>
                 <p class="itmestext"><?php echo $itmenamew;?></p>
                 <p class="itmestext">Quantity remained:<?php if($quantityfromitems<=0){
                   $quantityfromitems=0; 
                  echo $quantityfromitems; 
                 }else{
                     echo $quantityfromitems; 
                 } 
                 
                 ?></p>
           </div>
                <?php 
            }
            
            ?>
           
           <div class="messagesNodata" style="
            font-size: 20px;
    font-family: serif;
    display: none;
    flex-direction: column;
    justify-content: center;
    align-items: center;
           ">
                No any records today
            </div>
        </div>
        
    </div>
</div>
<script src="../myscript/home.js"></script>
<script src="../myscript/jQuerrylibarary.js"></script>
<script src="../myscript/users.js"></script>
<script src="../myscript/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<script>
 $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("gettingitmeHistory.php",
                function (data)
                {
                   
                    if(data==""){
                      document.querySelector('.messagesNodata').style.display="block";
                      document.querySelector('.messagesNodata').style.display="flex";
                      document.querySelector('.messagesNodata').style.flexDirection="column";
                      document.querySelector('.messagesNodata').style.justifyContent="center";
                      document.querySelector('.messagesNodata').style.alignItems="center";
                    }else{
                        var name = [];
                     var marks = [];
                    }
                     

                    for (var i in data) {
                        name.push(data[i].i_name);
                        marks.push(data[i].i_quantity);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'How many times is used per day',
                                backgroundColor:[
                                    'rgba(29, 225, 247, 1)',
                                    'rgba(29, 247, 105, 1)',
                                    'rgba(134, 247, 29, 1)',
                                    'rgba(247, 247, 29, 1)',
                                    'rgba(247, 152, 29, 1)',
                                    'rgba(247, 50, 29, 1)'
                                ],
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#myChart");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }

   document.querySelector('#imagescancle').addEventListener('click',()=>{
    document.querySelector('#displaydate').style.display="none";
   });

</script>



</body>
</html>
