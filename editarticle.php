<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include('db_connect.php');

$sql = "select * from article where ArticleID='".$_GET['id']."'";
$result = mysqli_query($con,$sql);


$outp = "";
while($rs = mysqli_fetch_array($result)) {

    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Categori_Name":"'  . $rs["CategoriName"] . '",';
        $outp .= '"Article_Title":"'   .$rs["ArticleTitle"] . '",';
        $outp .= '"Article_Desc":"'   .$rs["ArticleDesc"] . '",';
        $outp .= '"Article_ID":"'   .$rs["ArticleID"] . '",';
        $outp .= '"ImgPath":"'   .$rs["ImgPath"] . '"}';
}

echo $outp;
?>
