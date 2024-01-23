<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: http://localhost:3000");

header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//print_r($_POST);
//echo 'AAAAAAA';
$data = json_decode(file_get_contents("php://input"));
//print_r($data);
//die();
include('db_connect.php');


$sql = "delete from article where ArticleID='".$data->id."'";
$result = mysqli_query($con,$sql);

?>