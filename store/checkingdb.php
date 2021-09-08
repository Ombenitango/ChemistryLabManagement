<?php 
         $expireTime=time();
         $dateExpire=date('Y-m-d',$expireTime);
         include("../connection.php");
         $selectItems="SELECT*FROM items WHERE i_expire_date<='$dateExpire'";
         $resultOfselectedItems=mysqli_query($connection,$selectItems);
         if(mysqli_num_rows($resultOfselectedItems)>0){
         while($rowOfresualt=mysqli_fetch_array($resultOfselectedItems)){
          $i_name=$rowOfresualt[3];
          $i_category=$rowOfresualt[4];
          $i_quantity=$rowOfresualt[5];
          $i_description=$rowOfresualt[6];
          $i_images=$rowOfresualt[7];
          $i_price=$rowOfresualt[8];
          $serialNo=$rowOfresualt[1];
          $exprie=$rowOfresualt[2];
         $select="SELECT *FROM expire WHERE name='$i_name'";
         $che=mysqli_query($connection,$select);
         if(mysqli_num_rows($che)>0){
           
         } else {
            $quer="INSERT INTO expire(id,name,expiredate,cat,qu,price,serial)VALUES(0,'$i_name','$exprie','$i_category','$i_quantity','$i_price','$serialNo')";
            $done= mysqli_query($connection,$quer);
         }     
          

         }

        }else {
            echo "no expired items";
        }
          ?>