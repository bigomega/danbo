<link rel="shortcut icon" type="image/png" href="./favicon.png">
<title>Danbo - the ultra Knowledge tester</title>
<link href='bootstrap.css' rel='stylesheet'>
<script src='jquery.js'></script>
<script src='jquery-ui.js'></script>
<script src='bootstrap.js'></script>
<style type="text/css">
.navbar-inner{
	border-radius: 0px;
}
.row-fluid{
	margin-bottom: 20px;
}
.brand img{
	width: 30px;
	position: relative;
	top: -2px;
	margin-right: 5px;
}
.brand:hover{
	text-shadow: 0px 0px 5px;
}
form{
	border: 1px solid #ccc;
	padding-top: 20px;
	border-radius: 10px;
}
h1{
	text-shadow: 4px 4px 6px rgba(0,0,0,0.4);
}
a{
  color: rgb(143, 94, 41);
}
a:hover{
  color: rgb(68, 37, 2);
}
</style>

<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <a class="brand" href="#">
    	<img src="./danbo.png">
    	Danbo
    </a>
    <ul class="nav">
      <li><a href="./index.php">Home</a></li>
      <li><a href="./score.php">Scores</a></li>
      <li><a href="./random.php">Random</a></li>
    </ul>
    <ul class="nav pull-right">
      <li class="active"><a href="./about.php">About</a></li>
      <li><a href="./profile.php">Profile</a></li>
    </ul>
  </div>
</div>


<div class="container-fluid">
	<div class="row-fluid">
		<div class="span8 offset2">
			<h1>Danbo - the Ultra Knowledge tester </h1>
			<div class="row-fluid">
				<div class="span12 well">
					<h3>Team</h3>
					<a href="http://twitter.com/pradeepankmp" title="twitter">Pradeepan K</a><br>
					<a href="http://facebook.com/dhineshns" title="facebook">Dhinesh N</a><br>
					<a href="http://github.com/bigomega" title="github">Bharath R</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$('.brand').mouseover(function(){
	$('.brand img').attr('src','./danbo_flash.png');
})
$('.brand').mouseout(function(){
	$('.brand img').attr('src','./danbo.png');
})
</script>