<?php
	session_start();

	if (isset($_SESSION['logged'])) {	
		$user = $_SESSION["user"];
		$db = json_decode(file_get_contents("./oauth/.db"));

		if(property_exists($db->{'user'}, $user) == false){
	    header('location: ../error.php?user=1');
	    exit();
	  }

	  $score = $db->{'user'}->{$user}->{'score'};

	} else {
		header('location: ./login.php');
		exit();
	}
?>
<link rel="shortcut icon" type="image/png" href="./favicon.png">
<title>Danbo ScoreCard</title>
<link href='bootstrap.css' rel='stylesheet'>
<script src='jquery.js'></script>
<script src='jquery-ui.js'></script>
<script src='bootstrap.js'></script>
<style type="text/css">
.navbar-inner{
	border-radius: 0px;
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
.progress-green{
	background-image: linear-gradient(to right,rgb(0, 131, 0),rgba(255, 2, 2, 0.5));
	background-color:green;
	width:60%;
	float:left;
	line-height: 25px;/*
	border-bottom-left-radius: 10px;
	border-top-left-radius: 10px;*/
}
.progress-green span{
	color: #fff;
	margin-left: 10px;
}
.progress-red{
	background-image: linear-gradient(to right,rgba(0, 131, 0, 0.5),rgb(255, 2, 2));
	background-color:red;
	width:40%;
	float:left;
	line-height: 25px;/*
	border-bottom-right-radius: 10px;
	border-top-right-radius: 10px;*/
}
.progress-red span{
	color: #fff;
	float: right;
	margin-right: 10px;
}
.tot-green,.tot-red{
	background-image: none;
}
</style>

<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <a class="brand" href="./index.php">
    	<img src="./danbo.png">
    	Danbo
    </a>
    <ul class="nav">
      <li class="active"><a href="./index.php">Home</a></li>
      <li><a href="./score.php">Scores</a></li>
      <li><a href="./random.php">Random Set</a></li>
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
			<h3>Score</h3>
			<div class="row-fluid">
				<table class="table span12">
					<tr>
						<th>Topic</th>
						<th class="span1">Score</th>
						<th class="span8"></th>
					</tr>
					<?php
						foreach ($score as $key => $value) {
							$percent = $value->{'score'}*100/$value->{'total'};
							?>
							<tr>
								<td><?php echo str_replace("_", " ", $value->{'name'}); ?></td>
								<td><?php echo $value->{'score'}.'/'.$value->{'total'}; ?></td>
								<td>
									<div class="span12">
										<div style="width:<?php echo $percent; ?>%;" class="progress-green <?php if($percent==100){echo "tot-green";}?>">
											<span><?php echo $percent; ?>%</span>
										</div>
										<div style="width:<?php echo (100-$percent); ?>%;" class="progress-red <?php if($percent==0){echo "tot-red";}?>">
											<span><?php echo (100-$percent); ?>%</span>
										</div>
									</div>
								</td>
							</tr>
					<?php
						}
					?>
				</table>
			</div>
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