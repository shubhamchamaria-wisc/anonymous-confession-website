<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

<script type="text/javascript">
    function toggle(id,pageid,adminpid) 
    {
        var e = document.getElementById(id);
        if ( e.style.display == 'block' )
            e.style.display = 'none';
        else{
            e.style.display = 'block';
			e.style.display = 'none';
		}
		var note = $('textarea#'+adminpid).val();
		
		$.post("approvecon.php",{ id: id, pageid: pageid, note: note },function(data){
	

});
    }
	
    function toggle2(id,pageid) 
    {
        var e = document.getElementById(id);
        if ( e.style.display == 'block' )
            e.style.display = 'none';
        else{
            e.style.display = 'block';
			e.style.display = 'none';
		}
		
		
		$.post("deletecon.php",{ id: id, pageid: pageid },function(data){
	

});
    }
</script>
<head>
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
$id=$_GET['id'];
$result=mysqli_query($con,"SELECT * FROM pages WHERE username='$login' AND id='$id' LIMIT 1")or die("Could not query");
if(mysqli_num_rows($result) == 0)
{
	echo "You don't have admin privelages for this page";
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(mysqli_num_rows($result) == 1){
	
	$query=mysqli_query($con,"SELECT * FROM posts WHERE pageid='$id' AND approved=0")or die(mysqli_error($con));
	while($row = mysqli_fetch_assoc($query))
	{
		$pid=$row['id'];
		$username=$row['username'];
		$privacy=$row['privacy'];
		if($privacy == 1)
		{
			$username="Anon";
		}
		$content=$row['content'];
		$date=$row['datemade'];
?>
<div id="<?php echo $pid;?>"><?php echo $username; ?><br /><?php echo $content; ?><br />
<div id="note"><textarea id="243<?php echo $pid;?>" name="243<?php echo $pid;?>" placeholder="Admin's Note"></textarea></div>
<div id="approve" onclick="toggle(<?php echo $pid;?>,<?php echo $id; ?>,243<?php echo $pid;?>)" style="color:blue;">Approve</div>
<div id="delete" onclick="toggle2(<?php echo $pid;?>,<?php echo $id; ?>)" style="color:blue;">Delete</div>
</div><br />
<?php
	}
	
}



?>
</body>
</html>