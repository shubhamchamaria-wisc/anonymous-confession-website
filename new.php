<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function() 
{ 

$('body').on('change','#photoimg', function()
 {
var A=$("#imageloadstatus");
var B=$("#imageloadbutton");

$("#imageform").ajaxForm({target: '#image', 
}).submit();
});

}); 
</script>
<script type="application/javascript">
$(document).ready(function() {
    $('#edit').click(function() {
        $('#photoimg').click();
		
    });
});
</script>
<?php
if(!isset($_COOKIE['user']))
{
	header("Location: login.php");
}
include("dbinfo.php");
?>
<form id="imageform" method="post" enctype="multipart/form-data" action='ajaxupload.php'>
<input type="file" name="photoimg" id="photoimg" style="display:none;" />
<input type="button" id="edit" value="Upload" />
</form>
<form id="addpage" name="addpage" action="addpage.php" method="post">
<input id="name" name="name" placeholder="Name of Page" /><br><br>
<textarea id="bio" name="bio" rows="10" cols="35" style="resize:none;" placeholder="Write something about your page"></textarea><br>
<div id="image"></div><br>
Do you want to remain an anonymous admin?&nbsp;&nbsp;&nbsp;<select name="anon" id="anon"><option value="1">Yes</option><option value="0">No</option></select><br><br>
<input type="submit" name="submit" id="submit" />
</form>


