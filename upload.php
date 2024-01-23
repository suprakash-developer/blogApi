<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//print_r($_POST);

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileData"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
print_r(["fileData"]["name"]);
die();
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileData"]["tmp_name"]);
  if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
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
if ($_FILES["fileData"]["size"] > 500000) {
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
  if (move_uploaded_file($_FILES["fileData"]["tmp_name"], $target_file)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileData"]["name"])). " has been uploaded.";

   // inset query of mysql 
    
    $response=array(
     'status'=>'valid',
     
	);
	echo json_encode($response);
   
  } else {
     
  	 $response=array(
     'status'=>'invalid',
	);
  	 echo json_encode($response);
  }
}


die();

/*
$product_name = $data->product_name;
$product_price = $data->product_price;
$product_description = $data->product_description;

$con = mysqli_connect("localhost","root","");
mysqli_select_db($con,"phpmysql_simple_crud");

$sql = "insert into products(
	product_name,
	product_price,
	product_description
) 
values(
	'$product_name',
	'$product_price',
	'$product_description'
)";
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

*/
?>