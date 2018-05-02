<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0049)http://www.technationindia.com/trackbacc/FOrm.php -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript">

            function validateForm()

             {


                var firstname = document.getElementById("firstname").value;

                var lastname = document.getElementById("lastname").value;

                var username = document.getElementById("username").value;

                var emailid = document.getElementById("emailid").value;

                var password = document.getElementById("password").value;

                var confirmpwd = document.getElementById("confirmpwd").value;

                var birthyear = document.getElementById("birth").value;

                var count = 0;

                if (password == null || password == "") {
                    $(document).ready(function() {
			
			$("#password").css({ 'outline': 'red solid 1px','outline-offset':'-1px'});
		});
   
                    count++;
                }
                if (username == null || username == "") {
                    $(document).ready(function() {
			
			$("#username").css({ 'outline': 'red solid 1px','outline-offset':'-1px'});
		});
   
                    count++;
                }
                if (firstname == null || firstname == "") {
                    $(document).ready(function() {
			
			$("#firstname").css({ 'outline': 'red solid 1px','outline-offset':'-1px'});
		});
   
                    count++;
                }
                if (lastname == null || lastname == "") {
                   $(document).ready(function() {
			
			$("#lastname").css({ 'outline': 'red solid 1px','outline-offset':'-1px'});
		});
   
                    count++;
                }
                if (emailid == null || emailid == "") {
                   $(document).ready(function() {
			
			$("#emailid").css({ 'outline': 'red solid 1px','outline-offset':'-1px'});
		});
   
                    count++;
                }
                if (confirmpwd == null || confirmpwd == "") {
                    $(document).ready(function() {
			
			$("#confirmpwd").css({ 'outline': 'red solid 1px','outline-offset':'-1px'});
		});
   
                    count++;
                }
                if (birthyear == null || birthyear == "") {
                    $(document).ready(function() {
			
			$("#birth").css({ 'outline': 'red solid 1px','outline-offset':'-1px'});
		});
   
                    count++;
                }
                if (username.length < 6)

                {

                    alert("Username has to be more than 6 characters");

                    count++;

                }

                if (password != confirmpwd)

                {

                    alert("Passwords don't match");

                    count++;

                }


                if (count >= 1) {
                    return false;
                }




            }
        </script>
<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '1482306885319719', // Set YOUR APP ID
	      channelUrl : 'http://soupstick.co/channel.html', // Channel File
	      status     : true, // check login status
	      cookie     : true, // enable cookies to allow the server to access the session
	      xfbml      : true  // parse XFBML
	    });

	    FB.Event.subscribe('auth.authResponseChange', function(response) 
	    {
	     if (response.status === 'connected') 
	    {
	        document.getElementById("message").innerHTML +=  "<br>Connected to Facebook";
	        //SUCCESS

	    }    
	    else if (response.status === 'not_authorized') 
	    {
	        document.getElementById("message").innerHTML +=  "<br>Failed to Connect";

	        //FAILED
	    } else 
	    {
	        document.getElementById("message").innerHTML +=  "<br>Logged Out";

	        //UNKNOWN ERROR
	    }
	    }); 

	    };

	    function Login()
	    {

	        FB.login(function(response) {
	           if (response.authResponse) 
	           {
	                getUserInfo();
	            } else 
	            {
	             console.log('User cancelled login or did not fully authorize.');
	            }
	         },{scope: 'email,user_photos,user_friends'});

	    }

	  function getUserInfo() {
	        FB.api('/me', function(response) {


			  var firstname=response.first_name;
	          var lastname=response.last_name;
	          var username=response.name;
			  username=username.replace(/ /g, '');
			  username=username.toLowerCase();
	          var emailid=response.email;
			  var like=response.user_likes;
			  var fbid=response.id;
			 
	          
	          var location=response.location;
			  getPhoto();
	          var profile=getPhoto();
	          document.getElementById("firstname").value=firstname;
		      document.getElementById("lastname").value=lastname;
			  document.getElementById("username").value=username;
			  document.getElementById("emailid").value=emailid;
			  document.getElementById("fbid").value=fbid;
			
			  
			  

	    });
	    }
	    function getPhoto()
	    {
	      FB.api('/me/picture?type=normal', function(response) {

	          var str=response.data.url;
	          document.getElementById("avatar").value=str;

	    });

	    }
	    function Logout()
	    {
	        FB.logout(function(){document.location.reload();});
	    }

	  // Load the SDK asynchronously
	  (function(d){
	     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement('script'); js.id = id; js.async = true;
	     js.src = "//connect.facebook.net/en_US/all.js";
	     ref.parentNode.insertBefore(js, ref);
	   }(document));

	</script>
    
<?php
include("dbinfo.php");

if(isset($_COOKIE["user"]))
header ("Location: home.php");

if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) && isset( $_POST['submit'] ) && isset( $_POST['emailid'] ) && isset( $_POST['firstname'] ) && isset( $_POST['lastname'] ) && isset( $_POST['confirmpwd'] ) )
{
   
		$con=mysqli_connect($db_host,$db_username,$db_password,$db_database)or die("cannot connect");
$password=md5($_POST['password']);

   if ($stmt = mysqli_prepare($con, "SELECT id FROM users WHERE email=? LIMIT 1")) {
    mysqli_stmt_bind_param($stmt, "s", $_POST['emailid']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}
   if( $id != 0 ){
    header("Location: exists.php");
	exit();
	
   }//end if
    if ($stmt = mysqli_prepare($con, "SELECT id FROM users WHERE username=? LIMIT 1")) {
    mysqli_stmt_bind_param($stmt, "s", $_POST['username']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id2);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}
   if( $id2 != 0 ){
    header("Location: exists.php");
	exit();
	
   }//end if

if(!filter_var($_POST['emailid'], FILTER_VALIDATE_EMAIL))
{
	header("Location: exists.php");
}
//bind query
if ($stmt = mysqli_prepare($con, "INSERT INTO users (`firstname`,`lastname`,`username`,`email`,`password`,`picture`)
VALUES(?,?,?,?,?,?)")) {
    mysqli_stmt_bind_param($stmt, "ssssss", $_POST['firstname'],$_POST['lastname'],$_POST['username'],$_POST['emailid'],$password,$_POST['avatar']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
	}
	//end bind query
   
	header("location: login.php");
	exit();

    }
  




?>
<title>Soupstick</title>
</head>
<body>

 <div id="facebook" onclick="Login()" >Sign Up with Facebook</div>
 
<form class="pure-form" id="x" name="signUp" method="post" action="" onsubmit="return validateForm()">
    
  

  <input class="input" id="firstname" type="text" name="firstname" placeholder="First Name">
  <input id="lastname" class="input" type="text" name="lastname" placeholder="Last Name" />
  </br>
  <input class="input" id="username" type="text" name="username" placeholder="User Name" />
  </br>
  <input class="input" type="email" name="emailid" placeholder="Email ID" id="emailid" />
  </br>
  <input class="input" type="password" id="password" name="password" placeholder="Password" />
  </br>
  <input class="input" type="password" id="confirmpwd" name="confirmpwd" placeholder="Confirm Password" />
  </br>
  <input type="hidden" id="avatar" name="avatar" />
  <input type="hidden" id="fbid" name="fbid" />
  
  </br>
  <button type="submit" name="submit" value="&#10003;" class="pure-button pure-button-primary">&#10003;</button>
</form>

</div>
</body>


</html>