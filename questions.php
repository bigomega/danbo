<?php

session_start();

if(isset($_GET['key'])){
	$keyWord = $_GET['key'];
	$no = 10;

	if($keyWord == ''){
		header('location: ./suggestion.php');
		exit();
	}

	if(isset($_GET['no']))
		$no = $_GET['no'];

	if($no>40)
		$no = 40;

	$data = file_get_contents('http://localhost:5000/wiki?key='.$keyWord);
	$sentences = json_decode($data);
	json_last_error();

	if($sentences[0] == "NO DATA" || strpos($sentences[0],'may refer to') !== false || (strpos(strtolower($sentences[0]) , 'redirect') !== false && strpos(strtolower($sentences[0]) , 'redirect') < 5)){
		if(strpos($sentences[0],'may refer to') !== false)
			header('location: ./suggestion.php?key='.$keyWord.'&disamb=true');
		elseif (strpos(strtolower($sentences[0]) , 'redirect') !== false) {
			$redirectKey = str_replace(" ", "_", trim(substr($sentences[0], strpos(strtolower($sentences[0]) , 'redirect')+8)));
			header('location: ./questions.php?key='.$redirectKey);
		}
		else
			header('location: ./suggestion.php?key='.$keyWord);
		exit();
	}

	$data = file_get_contents('http://localhost:5000/keys?key='.$keyWord);
	$links = json_decode($data);
	json_last_error();

	$answers = array();
	$questions = array();

	?>
	<meta charset="UTF-8" />
	<link rel="shortcut icon" type="image/png" href="./favicon.png">
	<title>Danbo - Questions on <?php echo str_replace("_", " ", $keyWord); ?></title>
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
	.suggestion{
	  border: 1px solid #ccc;
	  border-radius: 10px;
	}
	h4{
	  margin-left: 21px;
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
	    <a class="brand" href="./index.php">
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
			<div class="span8 offset1">
				<form action="./answers.php?key=<?php echo $keyWord; ?>" method="POST">
					<h3><?php echo str_replace("_", " ", $keyWord); ?></h3><input style="display:none;" type="text" name="no" value="<?php echo $no; ?>"/>
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
		    $sendingQue = str_replace((string)$link, '<b> '.$link.' </b>', $sentence);
		    echo '<tr><td>'.($qno+1).'.</td><td>'.rtrim($que, '.').'?</td></tr><tr><td>Answer</td><td><input class="input span12" type="text" name="q'.$qno.'" id="q-'.$qno.'"/><hr/></td></tr>';
				$qno ++;
		    array_push($answers, $link);
		    array_push($questions, $sendingQue);
		    break;
			}
		}
	}

	$_SESSION['answers'] = $answers;
	$_SESSION['questions'] = $questions;
	?>
						</table>
					</div>
					<div class="row-fluid">
						<input type="submit" value="Submit" class="btn btn-inverse pull-right"/>
					</div>
				</form>
			</div>
			<div class="span3 suggestion">
	      <h4>May also mean</h4>
	      <ul>
	        <?php
					  $data = file_get_contents('http://localhost:5000/keys?key='.$keyWord.'_(disambiguation)');
						$disamb = json_decode($data);
		        foreach ($disamb as $i => $link) {
		          echo "<li><a href='./questions.php?key=".str_replace( " ", '_', $link)."'>".$link."</a></li>";
		        }
	        ?>
	      </ul>
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
	
	<?php
	exit();
}
else{
	header('location: ./suggestion.php');
	exit();
}

?>

