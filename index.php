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
</style>

<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <a class="brand" href="#">
    	<img src="./danbo.png">
    	Danbo
    </a>
    <ul class="nav">
      <li class="active"><a href="./index.php">Home</a></li>
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
		<div class="span8 offset2">
			<h1>Start Here</h1>
			<form class="form-search" action="./questions.php" method="GET">
				<div class="row-fluid">
					<div class="span12">
						<div class="input-append span12">
							<input id="key" type="text" name="key" class="span6 offset2 search-query" placeholder="Mythology, Java, Mango, etc..." style="border-bottom-left-radius: 0px;border-top-left-radius: 0px;">
							<button type="submit" class="btn btn-inverse">Search</button>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span1 offset2" style="line-height: 30px;">Ask me</div>
					<div class="span2" style="width: 60px;margin-left: 0px;">
						<select class="span12" name="no">
							<option>5</option>
							<option selected="selected">10</option>
							<option>15</option>
							<option>20</option>
							<option>25</option>
							<option>30</option>
							<option>35</option>
							<option>40</option>
						</select>
					</div>
					<div class="span1" style="line-height: 30px;margin-left: 5px;">Questions</div>
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
$("#key").unbind('keyup').keyup(function(ev){$(this).val($(this).val().replace(/ /g,"_"))});
</script>