<?php
// $data=file_get_contents('./db.json');
// echo $data;
function checkRemoteFile($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if(curl_exec($ch)!==FALSE)
    {
        return true;
    }
    else
    {
        return false;
 		}
}

$img = 'http://www.hoax-slayer.com/images/worlds-strongest-dog.jpg';
$goo = 'http://www.google.com/';

echo getimagesize($img);

if(checkRemoteFile($img))
	echo "yes".$img;
if(checkRemoteFile($goo))
	echo "NO".$goo;

exit();
?>


<link rel="shortcut icon" type="image/png" href="./favicon.png">
<title>Danbo - Your Profile</title>
<link href='bootstrap.css' rel='stylesheet'>
<script src='jquery.js'></script>
<script src='jquery-ui.js'></script>
<script src='bootstrap.js'></script>
<style type="text/css">
.navbar-inner{
	border-radius: 0px;
}
span{
	font-size: 20px;
}
img{
	width: 80px;
}
</style>

<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <a class="brand" href="./index.php">Danbo</a>
    <ul class="nav">
      <li class="active"><a href="./index.php">Home</a></li>
      <li><a href="./score.php">Scores</a></li>
      <li><a href="./random.php">Random Set</a></li>
    </ul>
    <ul class="nav pull-right">
      <li><a href="./profile.php">Profile</a></li>
    </ul>
  </div>
</div>


<div class="container-fluid">
	<div class="row-fluid">
		<div class="span8 offset2">
			<h3>Profile <small> <a href="javascript:void(0)">edit</a></small></h3>
			<div class="row-fluid">
				<div class="span12">
					<span>Name: </span>
					<span>User Name</span>
					<input type="text" value="User Name" style="display:none">
					<br><br>
					<span>Image: </span>
					<img src="Url">
					<input type="text" value="Url" style="display:none">
					<br><br>
					<button class="btn btn-primary hide">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>