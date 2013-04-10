<?php

if(isset($_GET['key'])){
	$data = file_get_contents('http://localhost:5000/wiki?key='.$_GET['key']);
}
else{
	header('location: /danbo-proj');
	exit();
}

?>

<link href='bootstrap.css' rel='stylesheet'>
<script src='jquery.js'></script>
<script src='jquery-ui.js'></script>
<script src='bootstrap.js'></script>
<style type="text/css">
.navbar-inner{
	border-radius: 0px;
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
			<h3>Topic</h3>
			<div class="row-fluid">
				<?php echo $data ?>
			</div>
		</div>
	</div>
</div>