<?php
include("dbinfo.php");
$username=$_POST['username'];
$password=md5($_POST['password']);
echo $username.$password;
$con=mysqli_connect($db_host,$db_username,$db_password,$db_database) or die("could not connect");
$sql="SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
$query=mysqli_query($con,$sql) or die(mysqli_error($con));
$row=mysqli_fetch_assoc($query);
if(mysqli_num_rows($query) == 1){
setcookie("user", $username, time()+ 172800,"/");
$pic = $row['picture'];
setcookie("pic", $pic, time()+ 172800,"/");
header("Location: home.php");
}
else{
	echo "wrong username/pssword";
}
?>