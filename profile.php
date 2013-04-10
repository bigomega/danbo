<?php
// $data=file_get_contents('./db.json');
// echo $data;

$data = file_get_contents('http://localhost:5000/keys?key=java');
$links = json_decode($data);
json_last_error();
// echo $links;

$data = file_get_contents('http://localhost:5000/wiki?key=java');
$senteces = json_decode($data);
json_last_error();
// echo $senteces;

foreach ($senteces as $key => $sentece) {
	foreach ($links as $key2 => $link) {
		if ((strpos($sentece,' '.$link.' ') !== false) || (strpos($sentece,' '.$link.'.') !== false) || (strpos($sentece,' '.$link.',') !== false) || (strpos($sentece,' '.$link.'\'') !== false) || (strpos($sentece, $link.' ') !== false)) {
	    $que = str_replace( (string)$link, ' _________ ', $sentece);
	    echo $key.') - '.rtrim($que, '.').'?<br/>';
	    break;
		}
	}
}



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