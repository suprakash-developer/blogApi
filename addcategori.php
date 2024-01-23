<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));
// print_r($data->Picture);
// die();
$cat_name = $_POST['catName'];
$cat_desc = $_POST['catDesc'];
include('db_connect.php');



$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["catImg"]["name"]);
$catImgPath = "http://localhost/blog-react/" . $target_file;
$cat_Img = basename($_FILES["catImg"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["catImg"]["tmp_name"]);
  if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";

    //$image_path = $target_file; // Adjust this based on your project structure
    //$insert_query = "INSERT INTO article (image_path) VALUES ('$image_path')";

    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["catImg"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["catImg"]["tmp_name"], $target_file)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileData"]["name"])). " has been uploaded.";

if($cat_name && $cat_desc){
$sql = "insert into categories(
	catName,
	catDesc,
	catImg
) 
values(
	'$cat_name',
	'$cat_desc',
	'$catImgPath'
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