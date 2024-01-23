<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include('db_connect.php');

$data = json_decode(file_get_contents("php://input"));
//print_r($data);
//die();
$CategoriName = $data->Categori_Name;
$ArticleTitle = $data->Article_Title;
$ArticleID = $data->Article_ID;
$ArticleDesc = $data->Article_Desc;
$ImgPath = $data->ImgPath;



$sql = "update article set 
CategoriName='$CategoriName',ArticleTitle='$ArticleTitle',ArticleDesc='$ArticleDesc'
 where ArticleID=$ArticleID";

$result = mysqli_query($con,$sql);

if($result){

	$response=array(
     'status'=>'valid'
	);
	echo json_encode($response);
}
else{
	 $response=array(
      'status'=>'invalid'
	);
	echo json_encode($response);
}
?>