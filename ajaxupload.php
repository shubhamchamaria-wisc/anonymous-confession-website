<?php
include('dbinfo.php');
$con=mysqli_connect($db_host,$db_username,$db_password,$db_database)or die("Could not connect");
$path = "pictures/";
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
function getExtension($str)
{
$i = strrpos($str,".");
if (!$i)
{
return "";
}
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}
$imagename = $_FILES['photoimg']['name'];
$size = $_FILES['photoimg']['size'];
if(strlen($imagename))
{
$ext = strtolower(getExtension($imagename));
if(in_array($ext,$valid_formats))
{
if($size<(1024*1024)) // Image size max 1 MB
{
$actual_image_name = time().md5($login).".".$ext;
$main="pictures/".$actual_image_name;
$uploadedfile = $_FILES['photoimg']['tmp_name'];

//Original Image
if(move_uploaded_file($uploadedfile, $path.$actual_image_name))
{
//Insert upload image files names into user_uploads table
setcookie("pic",'',time()-1000);
setcookie("pic",$main, time()+ 172800,"/");
mysqli_query($con,"UPDATE users SET picture='$main' WHERE username='$login'");
echo '<input type="hidden" id="pagepic" name="pagepic" value="'.$main.'" />';
}
else
echo "failed";
}
else
echo "Image file size max 1 MB"; 
}
else
echo "Invalid file format.."; 
}
else
echo "Please select image..!";
exit;
}
?>