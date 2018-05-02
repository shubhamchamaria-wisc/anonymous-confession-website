<?php
include("dbinfo.php");
$con=mysqli_connect($db_host,$db_username,$db_password,$db_database)or die("Could not connect");
if(isset($_POST['submit'])){
	
	if ($stmt = mysqli_prepare($con, "INSERT INTO pages (`username`,`name`,`bio`,`picture`,`privacy`)
VALUES(?,?,?,?,?)")) {
    mysqli_stmt_bind_param($stmt, "sssss", $login,$_POST['name'],$_POST['bio'],$_POST['pagepic'],$_POST['anon']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
	}
	header("Location: new.php");
	
}

?>