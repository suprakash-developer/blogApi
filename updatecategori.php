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
$cat_name = $_POST['catName'];
$cat_desc = $_POST['catDesc'];
$catID = $_POST['catID'];

include('db_connect.php');



$target_dir = "images/";
$fileName = basename($_FILES["catImg"]["name"]);
$target_file = $target_dir . basename($_FILES["catImg"]["name"]);
if($fileName!=null){
$catImgPath = "http://localhost/blog-react/" . $target_file;
} else {
	$catImgPath="";
}
$cat_Img = basename($_FILES["catImg"]["name"]);


if(move_uploaded_file($_FILES["catImg"]["tmp_name"], $target_file)){

}
$sql = "update categories set 
catName='$cat_name',catDesc='$cat_desc',catImg='$catImgPath'
 where catID=$catID";

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