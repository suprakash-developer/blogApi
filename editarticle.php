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
        $outp .= '{"ArticleID":"'   .$rs["ArticleID"] . '",';
        $outp .= '"postTitle":"'   .$rs["postTitle"] . '",';
        $outp .= '"postDesc":"'   .stripslashes($rs["postDesc"]) . '",';
        $outp .='"postcatName":"'  . $rs["postcatName"] . '",';
        $outp .='"postCategori":"'  . $rs["postCategori"] . '",';
        $outp .='"postauthName":"'  . $rs["postauthName"] . '",';
        $outp .='"postAuthor":"'  . $rs["postAuthor"] . '",';
        $outp .= '"postImage":"'   .$rs["postImage"] . '"}';
}

echo $outp;
?>
