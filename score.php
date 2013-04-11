<?php
	if (isset($_GET['logged'])) {
		# code...
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
.progress-green{
	background-image: linear-gradient(to right,rgb(0, 131, 0),rgba(255, 2, 2, 0.5));
	background-color:green;
	width:60%;
	float:left;
	line-height: 25px;
	border-bottom-left-radius: 10px;
	border-top-left-radius: 10px;
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
	line-height: 25px;
	border-bottom-right-radius: 10px;
	border-top-right-radius: 10px;
}
.progress-red span{
	color: #fff;
	float: right;
	margin-right: 10px;
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
					<tr>
						<td>Java</td>
						<td>6</td>
						<td>
							<div class="span12">
								<div style="width:60%;" class="progress-green">
									<span>60%</span>
								</div>
								<div style="width:40%;" class="progress-red">
									<span>40%</span>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>Bed</td>
						<td>10</td>
						<td>
							<div class="span12">
								<div style="width:100%;" class="progress-green">
									<span>100%</span>
								</div>
								<div style="width:0%;" class="progress-red">
									<span>0%</span>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>