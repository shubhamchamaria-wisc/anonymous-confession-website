<?php
include("dbinfo.php");

$con=mysqli_connect($db_host,$db_username,$db_password,$db_database)or die("Could not connect");
$id=$_POST['id'];

$result=mysqli_query($con,"SELECT * FROM counters WHERE postid='$id' LIMIT 1")or die(mysqli_error($con));
$row= mysqli_fetch_assoc($result);
$likearray=$row['hatearray'];

if($likearray === "")
{
	$likearray=array($login);
	
}
else{
$likearray = unserialize($likearray);
$likearray[]=$login;
}
$number=count($likearray);
$likearray=serialize($likearray);
mysqli_query($con,"UPDATE counters SET hatearray='$likearray' WHERE postid='$id'")or die(mysqli_error($con));

?>