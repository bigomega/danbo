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
	padding-left: 20px;
	padding-top: 20px;
	border-radius: 10px;
}
h4{
	border-bottom: 1px solid #ccc;
	padding-bottom: 5px;
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
      <li><a href="./about.php">About</a></li>
      <li><a href="./profile.php">Profile</a></li>
    </ul>
  </div>
</div>


<div class="container-fluid">
	<div class="row-fluid">
		<div class="span4 offset4">
			<h3>Please login/register to continue</h3>
			<form action="./oauth/" method="POST" id="form1">
				<div class="row-fluid">
					<div class="span4">
						User Name:
					</div>
					<input type="text" class="input span8" name="user" />
				</div>
				<div class="row-fluid">
					<div class="span4">
						Password: 
					</div>
					<input type="text" class="input span8" name="pass" />
				</div>
				<div class="row-fluid">
					<div class="span4 offset4">
						<input type="submit" name="login" value="Login" class="btn btn-inverse">
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<a href="javascript:void(0);" class="registerLogin">or Register here</a> if you are new
					</div>
				</div>
			</form>
			<form action="./oauth/create.php" method="POST" class="hide" id="form2">
				<div class="row-fluid">
					<div class="span4">
						User Name:
					</div>
					<input type="text" class="input span8" name="user" />
				</div>
				<div class="row-fluid">
					<div class="span4">
						Password: 
					</div>
					<input type="text" class="input span8" name="pass" />
				</div>
				<div class="row-fluid">
					<div class="span4">
						Confirm Password: 
					</div>
					<input type="text" class="input span8" name="pass-confirm" />
				</div>
				<div class="row-fluid">
					<div class="span4 offset4">
						<input type="submit" name="login" value="Register" class="btn btn-inverse">
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<a href="javascript:void(0);" class="registerLogin">or Login here</a> if you are already a member
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$('.brand').mouseover(function(){
	$('.brand img').attr('src','./danbo_flash.png');
});
$('.brand').mouseout(function(){
	$('.brand img').attr('src','./danbo.png');
});

$(".registerLogin").click(function(){
	$("#form1").slideToggle(500);
	$("#form2").slideToggle(500);
});
</script>