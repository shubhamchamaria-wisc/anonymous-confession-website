<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style>
#buttons{
width: 80px;
	height: 80px;
	background: red;
	color:#fff;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size:12px;
	margin-right:600px;
}
#item{
	height:90px;
}
.first{
	float:left;
	height:40px;
	width:40px;
	background:#33B5e5;
	
}
#second{
	float:left;
	height:40px;
	width:40px;
	background:#aa66CC;
}
#third{
	float:left;
	height:40px;
	width:40px;
	background:blue;
}
#fourth{
	float:left;
	height:40px;
	width:40px;
	background:#99cc00;
}


</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function() 
{ 

$('#submit').click(function(){
 
$("#sendcon").ajaxForm({target: '#maintext', 
}).submit();
});

}); 
</script>
<script type="text/javascript">
function like(id) 
    {
       
		
		$.post("likecon.php",{ id: id },function(data){
			
	});
    }

</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
</head>

<body>
<?php
$id=$_GET['id'];
if(!isset($_GET['id'])){
	header("Location: home.php");
}
if(!isset($_COOKIE['user']))
{
	header("Location: login.php");
}
include("dbinfo.php");
$con=mysqli_connect($db_host,$db_username,$db_password,$db_database)or die("Could not connect");
?>
<div id="maintext">
<form id="sendcon" name="sendcon" action="sendcon.php" method="post">
<textarea id="con" name="con" placeholder="Post a confession"></textarea><br />
Hide identity<input type="checkbox" value="1" name="check" checked="checked" />
<input type="hidden" name="pageid" id="pageid" value="<?php echo $id;?>" />
<input type="submit" value="submit" id="submit" />
</form>
</div>
<?php
$query=mysqli_query($con,"SELECT * FROM posts WHERE pageid='$id' AND approved=1 ")or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($query))
{
	$id=$row['id'];
	$privacy=$row['privacy'];
	$user=$row['username'];
	if($privacy == 1)
	{
		$user="Anon";
		
	}
	$content=$row['content'];
	$note=$row['note'];
?>
<div id="item">
<div id="buttons" style="float:right;"><div class="first" id="<?php echo $id; ?>" onclick='like(<?php echo $id;?>)'>Like</div><div id="second">Hate</div><div id="third">True</div><div id="fourth">Fake</div></div>
<?php echo $user;?> <br /> <b><?php echo $content;  ?></b> <br />
<strong>Admin's Note:</strong> <?php echo $note; ?>

<br /><br />
</div>
<?php
}
?>
</body>
</html>