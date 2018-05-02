<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Untitled Document</title>
</head>

<body>
<?php
include("dbinfo.php");
$con=mysqli_connect($db_host,$db_username,$db_password,$db_database)or die("Could not connect");
$query="SELECT * FROM pages WHERE username='$login'";
$result=mysqli_query($con,$query)or die(mysqli_error($con));
while($row = mysqli_fetch_assoc($result) )
{
	$name=$row['name'];
	$pic=$row['picture'];
	echo $name;
	
}
?>
</body>
</html>