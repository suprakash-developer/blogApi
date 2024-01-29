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
$ArticleTitle = $_POST['postTitle'];
$ArticleDesc = htmlentities($_POST['postDesc']);
$CategoriName = $_POST['postcatName'];
$CategoriId = $_POST['postCategori'];
$AuthName = $_POST['postauthName'];
$AuthID = $_POST['postAuthor'];
$ImgPath = $_POST['postImage'];



// $ArticleID = $data->ArticleID;
// $ArticleTitle = $data->postTitle;
// $ArticleDesc = $data->postDesc;
// $CategoriName = $data->postcatName;
// $CategoriId = $data->postCategori;
// $AuthName = $data->postauthName;
// $AuthID = $data->postAuthor;
// $ImgPath = $data->postImage;
$target_dir = "images/";
$fileName = basename($_FILES["postImage"]["name"]);
$target_file = $target_dir . basename($_FILES["postImage"]["name"]);
if($fileName!=null){
$postImagePath = "http://localhost/blog-react/" . $target_file;
} else {
	$postImagePath=$ImgPath;
}
$cat_Img = basename($_FILES["postImage"]["name"]);


if(move_uploaded_file($_FILES["postImage"]["tmp_name"], $target_file)){

}


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