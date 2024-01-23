<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
$conn = mysqli_connect("localhost", "root", "", "StudentsDB");
 
$result = mysqli_query($conn,"SELECT sno,name,course from students");
 
$outp = "";
while($rs = mysqli_fetch_array($result)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"sno":"'  . $rs["sno"] . '",';
    $outp .= '"name":"'   .$rs["name"]        . '",';
    $outp .= '"course":"'. $rs["course"]     . '"}'; 
}
$outp ='{"records":['.$outp.']}';
$conn->close();
 
echo($outp);
?>