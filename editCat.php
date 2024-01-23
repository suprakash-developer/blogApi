<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include('db_connect.php');

$sql = "select * from categories where catID='".$_GET['id']."'";
$result = mysqli_query($con,$sql);


$outp = "";
while($rs = mysqli_fetch_array($result)) {

    if ($outp != "") {$outp .= ",";}
    $outp .= '{"catName":"'  . $rs["catName"] . '",';
        $outp .= '"catDesc":"'   .$rs["catDesc"]        . '",';
        $outp .= '"catImg":"'   .$rs["catImg"]        . '",';
        $outp .= '"catID":"'   .$rs["catID"]        . '"}';
}

echo $outp;
?>
