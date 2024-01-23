<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));
// print_r($data->Picture);
// die();
// $Categori_Name = $data->postCategori;
// $Article_Title = $data->postTitle;
// $Article_Desc = $data->postDesc;
// $AuthorName = $data->postAuthor;
$Categori_Name = $_POST['postCategori'];
$Article_Desc = $_POST['postDesc'];
$Article_Title = $_POST['postTitle'];
$AuthorName = $_POST['postAuthor'];

include('db_connect.php');

if($Article_Title && $Article_Desc){
$sql = "insert into article(
	postCategori,
	postTitle,
	postDesc,
	postAuthor
) 
values(
	'$Categori_Name',
	'$Article_Title',
	'$Article_Desc',
	'$AuthorName'
)";
$result = mysqli_query($con,$sql);

if($result){

	$response['data']=array(
     'status'=>'valid'
	);
	echo json_encode($response);
}
else{
	 $response['data']=array(
      'status'=>'invalid'
	);
	echo json_encode($response);
}
}
?>