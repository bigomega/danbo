<?php

session_start();

if(isset($_GET['key'])){
	$keyWord = $_GET['key'];
	$no = 10;

	if($keyWord == ''){
	header('location: ./');
	exit();
	}

	if(isset($_GET['no']))
		$no = $_GET['no'];


	$data = file_get_contents('http://localhost:5000/keys?key='.$keyWord);
	$links = json_decode($data);
	json_last_error();

	$data = file_get_contents('http://localhost:5000/wiki?key='.$keyWord);
	$sentences = json_decode($data);
	json_last_error();

	$answers = array();

	?>
	<link rel="shortcut icon" type="image/png" href="./favicon.png">
	<title>Danbo - Questions on <?php echo $keyWord; ?></title>
	<link href='bootstrap.css' rel='stylesheet'>
	<script src='jquery.js'></script>
	<script src='jquery-ui.js'></script>
	<script src='bootstrap.js'></script>
	<style type="text/css">
	.navbar-inner{
		border-radius: 0px;
	}
	.td{
		overflow: scroll;
		text-overflow: ellipsis;
	}
	h3{
		text-transform: capitalize;
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
				<form action="./answers.php?key=<?php echo $keyWord; ?>" method="POST">
					<h3><?php echo $keyWord; ?></h3><input style="display:none;" type="text" name="no" value="<?php echo $no; ?>"/>
					<div class="row-fluid">
						<table class='table table-bordered table-hover span12'>
							<tr>
								<th>No.</th>
								<th>Question</th>
							</tr>
	<?php

	$qno = 0;
	foreach ($sentences as $key => $sentence) {
		// echo $sentence;
		if($no == $qno)
			break;

		if(rand()%2==0) #removing random sentences
			continue;

		foreach ($links as $key2 => $link) {
			if($no == $qno)
				break;

			if ((strpos($sentence,' '.$link.' ') !== false) || (strpos($sentence,' '.$link.'.') !== false) || (strpos($sentence,' '.$link.',') !== false) || (strpos($sentence,' '.$link.'\'') !== false) || (strpos($sentence, $link.' ') !== false)) {
		    $que = str_replace( (string)$link, ' _________ ', $sentence);
		    echo '<tr><td>'.($qno+1).'.</td><td>'.rtrim($que, '.').'?</td></tr><tr><td>Answer</td><td><input class="input span12" type="text" name="q'.$qno.'" id="q-'.$qno.'"/><hr/></td></tr>';
				$qno ++;
		    array_push($answers, $link);
		    break;
			}
		}
	}

	$_SESSION['answers'] = $answers;
	?>
						</table>
					</div>
					<div class="row-fluid">
						<input type="submit" value="Submit" class="btn btn-inverse pull-right"/>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<?php
	exit();
}
else{
	header('location: ./');
	exit();
}

?>

