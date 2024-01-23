<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
$con = mysqli_connect("localhost","root","");
mysqli_select_db($con,"blog");

$data = json_decode(file_get_contents("php://input"));
//print_r($data);
$email = $data->email;
$password = $data->password; 
//die();

//echo "SELECT * from employee where email='".$email."' AND password='".$password."'";

$result = mysqli_query($con,"SELECT * from employee where Email='".$email."'  AND Password='".$password."'");

$nums = mysqli_num_rows($result);
$rs=mysqli_fetch_array($result);
//die();
if($nums>=1){
   
    http_response_code(200);
   $outp = "";
  //while($rs = mysqli_fetch_array($result)) {
   // if ($outp != "") {$outp .= ",";}
		   
		    $outp .= '{"Email":"'  . $rs["Email"] . '",';
		    $outp .= '"FirstName":"'   .$rs["FirstName"]. '",';
		    $outp .= '"status":"200",';
		    $outp .= '"LastName":"'   .$rs["LastName"]. '",';
		    $outp .= '"Password":"'. $rs["Password"].'"}'; 
    //}

    echo $outp;
}
else{

     http_response_code(202);
}

?>