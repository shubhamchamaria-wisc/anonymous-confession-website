<?php
include("dbinfo.php");
$con=mysqli_connect($db_host,$db_username,$db_password,$db_database)or die("Could not connect");
$data=$_POST['con'];
$privacy=$_POST['check'];
if(!isset($_POST['privacy']))
{
	$privacy=0;
}
if ($stmt = mysqli_prepare($con, "INSERT INTO posts (`username`,`content`,`privacy`,`datemade`,`pageid`)
VALUES(?,?,?,now(),?)")) {
    mysqli_stmt_bind_param($stmt, "ssss", $login,$data,$privacy,$_POST['pageid']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
	echo "Sort";
	}
?>