<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
if(isset($_COOKIE["user"]))
{
header ("location: home.php");
}
?>
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>NPP-Staff Login</title>
<link href="signin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function formValidate()
{
	//Validate Username, Password
	var username= document.getElementById("username").value;
        var password= document.getElementById("password").value;
	
if(username==null || username=="" || password==null || password=="")	
{
		alert("No field can be left blank");
		return false;
	}
}
	</script>
</head>

<body>
Confession Website Signin
<div id="signin">
<form id="login" method="post" action="checklogin.php" name="login" onsubmit="return formValidate()"/>
<input id="username" name="username" type="text" placeholder="Username"/>
<input name="password" type="password" id="password" placeholder="Password" />
<input type="submit" id="submit" name="submit" value="Sign In" />
</div>
</body>
</html>
	
