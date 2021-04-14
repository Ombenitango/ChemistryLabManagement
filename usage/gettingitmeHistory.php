<?php 
header('Content-Type: application/json');
include("../connection.php");
$time=time();
$timeHr=date("Y/m/d",$time);


$selectItemsH="SELECT i_name,COUNT(i_quantity) AS i_quantity FROM itemhistory  WHERE i_date>=DATE(NOW())-INTERVAL 7 DAY GROUP by i_name;
";

$result=mysqli_query($connection,$selectItemsH);
$rowAffected=mysqli_num_rows($result);
if($rowAffected>0){
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
}else{
	$data[]="";
}


mysqli_close($connection);

echo json_encode($data);
?>