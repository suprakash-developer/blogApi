<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));
// print_r($data->Picture);
// die();
$first_name = $data->FirstName;
$last_name = $data->LastName;
$email = $data->Email;
$password = $data->Password;
$con = mysqli_connect("localhost","root","");
mysqli_select_db($con,"blog");

if($first_name && $last_name){
$sql = "insert into employee(
	FirstName,
	LastName,
	Email,
	Password
) 
values(
	'$first_name',
	'$last_name',
	'$email',
	'$password'
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