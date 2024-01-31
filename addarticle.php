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
$Categori_ID = $_POST['postCategori'];
$Categori_Name = $_POST['postcatName'];
$Article_Desc = htmlentities($_POST['postDesc']);
$Article_Title = $_POST['postTitle'];
$NameAuth = $_POST['postauthName'];
$AuthorName = $_POST['postAuthor'];

include('db_connect.php');

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["postImage"]["name"]);
$postImagePath = "http://localhost/blog-react/" . $target_file;
$post_Img = basename($_FILES["postImage"]["name"]);
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
  if (move_uploaded_file($_FILES["postImage"]["tmp_name"], $target_file)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileData"]["name"])). " has been uploaded.";


if($Article_Title && $Article_Desc && $postImagePath){
$sql = "insert into article(
	postCategori,
  postcatName,
	postTitle,
	postDesc,
	postAuthor,
  postauthName,
	postImage
) 
values(
  '$Categori_ID',
	'$Categori_Name',
	'$Article_Title',
	'$Article_Desc',
	'$AuthorName',
  '$NameAuth',
	'$postImagePath'

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