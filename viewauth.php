<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include('db_connect.php');

 
$result = mysqli_query($con,"SELECT * from authors");
 
$outp = "";
while($rs = mysqli_fetch_array($result)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"authName":"'  . $rs["authName"] . '",';
    $outp .= '"authDesc":"'   .$rs["authDesc"]        . '",';
    $outp .= '"authImg":"'   .$rs["authImg"]        . '",';
    $outp .= '"authID":"'   .$rs["authID"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
//$conn->close();
 
echo($outp);
?>