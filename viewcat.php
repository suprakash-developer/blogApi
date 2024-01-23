<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include('db_connect.php');

 
$result = mysqli_query($con,"SELECT * from categories");
 
$outp = "";
while($rs = mysqli_fetch_array($result)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"catName":"'  . $rs["catName"] . '",';
    $outp .= '"catDesc":"'   .$rs["catDesc"]        . '",';
    $outp .= '"catImg":"'   .$rs["catImg"]        . '",';
    $outp .= '"catID":"'   .$rs["catID"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
//$conn->close();
 
echo($outp);
?>