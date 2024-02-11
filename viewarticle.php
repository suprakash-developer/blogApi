<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include('db_connect.php');

 
$result = mysqli_query($con,"SELECT * from article");
 
$outp = "";
while($rs = mysqli_fetch_array($result)) {
    
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"postCategori":"'  . $rs["postCategori"] . '",';
    $outp .= '"postcatName":"'  . $rs["postcatName"] . '",';
    $outp .= '"postTitle":"'   .$rs["postTitle"] . '",';
    $outp .= '"postDesc":"'    .stripslashes($rs["postDesc"]) . '",';
    $outp .= '"ArticleID":"'   .$rs["ArticleID"] . '",';
    $outp .= '"postAuthor":"'   .$rs["postAuthor"] . '",';
    $outp .= '"postauthName":"'   .$rs["postauthName"] . '",';
    $outp .= '"postImage":"'   .$rs["postImage"] . '"}';
}
$outp ='{"records":['.$outp.']}';
//$conn->close();
echo $outp;
?>