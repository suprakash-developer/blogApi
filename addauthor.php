<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));
// print_r($data->Picture);
// die();
$auth_name = $_POST['authName'];
$auth_desc = $_POST['authDesc'];
include('db_connect.php');



$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["authImg"]["name"]);
$authImgPath = "http://localhost/blog-react/" . $target_file;
$cat_Img = basename($_FILES["authImg"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["authImg"]["tmp_name"]);
  if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";

    //$image_path = $target_file; // Adjust this based on your project structure
    //$insert_query = "INSERT INTO article (image_path) VALUES ('$image_path')";

    $uploadOk = 1;
  } else {
    $emessage= "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $emessage= "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["authImg"]["size"] > 500000) {
  $emessage= "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $emessage= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //echo "Sorry, your file was not uploaded.";
  $response=array(
    'status'=>'invalid',
    'message'=>$emessage
 );
 echo json_encode($response);
// if everything is ok, try to upload file
} else {
  $response=array(
    'status'=>'valid'
 );
 echo json_encode($response);
  if (move_uploaded_file($_FILES["authImg"]["tmp_name"], $target_file)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileData"]["name"])). " has been uploaded.";

if($auth_name && $auth_desc){
$sql = "insert into authors(
	authName,
	authDesc,
	authImg
) 
values(
	'$auth_name',
	'$auth_desc',
	'$authImgPath'
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
  }
  }
?>