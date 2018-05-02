<?php
include("dbinfo.php");

$con=mysqli_connect($db_host,$db_username,$db_password,$db_database)or die("Could not connect");
$id=$_POST['id'];
$pageid=$_POST['pageid'];
$note=$_POST['note'];
$result=mysqli_query($con,"SELECT * FROM pages WHERE username='$login' AND id='$pageid' LIMIT 1")or die("Could not query");
if(mysqli_num_rows($result) == 0)
{
	echo "You don't have admin privelages for this page";
	exit();
}
mysqli_query($con,"UPDATE posts SET approved=1 WHERE id='$id'");
mysqli_query($con,"UPDATE posts SET note='$note' WHERE id='$id'");
mysqli_query($con,"INSERT INTO counters (`postid`) VALUES ('$id')");
echo "LAD";
?>