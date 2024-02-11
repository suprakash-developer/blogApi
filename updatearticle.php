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
$ArticleID = $_POST['ArticleID'];
$ArticleTitle = htmlentities($_POST['postTitle']);
$ArticleDesc = addslashes($_POST['postDesc']);
$CategoriName = $_POST['postcatName'];
$CategoriId = $_POST['postCategori'];
$AuthName = $_POST['postauthName'];
$AuthID = $_POST['postAuthor'];



if(!empty($_FILES)){
$target_dir = "images/";
$fileName = basename($_FILES["postImage"]["name"]);
$target_file = $target_dir . basename($_FILES["postImage"]["name"]);
$postImagePath = "http://localhost/blog-react/" . $target_file;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["postImage"]["tmp_name"]);
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
  if ($_FILES["postImage"]["size"] > 500000) {
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


if(move_uploaded_file($_FILES["postImage"]["tmp_name"], $target_file)){

$sql = "update article set 
postTitle='$ArticleTitle',
postDesc ='$ArticleDesc',
postCategori='$CategoriId',
postcatName ='$CategoriName',
postAuthor='$AuthID',
postauthName='$AuthName',
postImage ='$postImagePath'
 where ArticleID=$ArticleID";
$result = mysqli_query($con,$sql);

	$response=array(
     'status'=>'valid'
	);
	echo json_encode($response);

}
} 
} else {

	$ImgPath = $_POST['postImage'];
	$postImagePath=$ImgPath;
	$sql = "update article set 
postTitle='$ArticleTitle',
postDesc ='$ArticleDesc',
postCategori='$CategoriId',
postcatName ='$CategoriName',
postAuthor='$AuthID',
postauthName='$AuthName',
postImage ='$postImagePath'
 where ArticleID=$ArticleID";
$result = mysqli_query($con,$sql);
$response=array(
	'status'=>'valid'
  );
  echo json_encode($response);
}

?>