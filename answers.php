<?php

session_start();

if(isset($_POST['no']) && intval($_POST['no']) > 0 && isset($_SESSION['answers'])){
	$keyWord = $_GET['key'];
	$no = $_POST['no'];
	$answers = $_SESSION['answers'];
	?>

	<meta charset="UTF-8" />
	<link rel="shortcut icon" type="image/png" href="./favicon.png">
	<title>Danbo - Answers for <?php echo $keyWord; ?></title>
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
	.brand img{
		width: 30px;
		position: relative;
		top: -2px;
		margin-right: 5px;
	}
	.brand:hover{
		text-shadow: 0px 0px 5px;
	}
	h3{
		text-transform: capitalize;
	}
	.correct{
		color: green;
		font-weight: bold;
	}
	.wrong{
		color: red;
		font-weight: bold;
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
				<h3><?php echo $keyWord; ?> answers</h3>
				<div class="row-fluid">
					<table class='table table-bordered table-hover span12'>
						<tr>
							<th>No.</th>
							<th>Given Answer</th>
							<th>Correct Answer</th>
							<th>Score</th>
						</tr>

	<?php
	$score = 0;
	$total = count($answers);
	foreach ($answers as $i => $answerU) {
		$given = strtolower($_POST["q".$i]);
		$answer = strtolower($answerU);
		$fullAnswer = $_SESSION['questions'][$i];

		echo '<tr><td>'.($i+1).'</td><td>'.$given.'</td><td data-toggle="popover" data-placement="bottom" data-html="true" data-trigger="hover" data-title="" data-content="'.$fullAnswer.'" data-container="body">'.$answerU;

		$percent = (strlen($answer)-levenshtein($answer, $given))/strlen($answer);

		if($percent > 0.8){
			echo '</td><td class="correct">Correct</td></tr>';
			$score ++;
		}
		else{
			echo '</td><td class="wrong">Wrong</td></tr>';
		}
	}
	unset($_SESSION['answers']);
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
	<script type="text/javascript">
	$('td').popover();
	</script>
	<script type="text/javascript">
	 $.ajax({
	 	url:'./oauth/update.php',
	 	type: 'GET',
	 	data: {
	 		key: "<?php echo $keyWord;?>",
	 		score: "<?php echo $score;?>",
	 		total: "<?php echo $total;?>"
	 	},
	 	success:function(){
	 		console.log('success');
	 	},
	 	error: function(){
	 		console.log('error');
	 	}
	 });
	</script>
	<?php
} else{
	header('location: ./');
	exit();
}

?>