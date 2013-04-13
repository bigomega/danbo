<?php

$key = "";
$mock = array("Chuck Norris");
$suggestion = $mock[rand()%sizeof($mock)];

if(isset($_GET['key']) && $_GET['key']!=""){
  $key = $_GET['key'];
  $resp = (string)file_get_contents('http://localhost:4567/spell/'.$key);
  if($key != $resp)
    $suggestion = $resp;
}

$suggestionU = str_replace(" ", "_", $suggestion);

if(isset($_GET['disamb']))
  $data = file_get_contents('http://localhost:5000/keys?key='.$key);
else
  $data = file_get_contents('http://localhost:5000/keys?key='.$key.'_(disambiguation)');
$disamb = json_decode($data);

?>
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
a{
  color: rgb(143, 94, 41);
}
a:hover{
  color: rgb(68, 37, 2);
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
.main{
  border: 1px solid #ccc;
  border-radius: 10px;
  padding-left: 20px;
}
h3{
  border-bottom: 1px solid #ddd;
}
.sugg a{
  font-size: 25px;
  line-height: 25px;
  text-transform: lowercase;
}
.suggestion{
  border: 1px solid #ccc;
  border-radius: 10px;
}
h4{
  margin-left: 21px;
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
    <div class="span6 offset3 main">
      <h3>Not Found</h3>
      <div class="row-fluid">
        <div class="span12 sugg">
          The term <i>"<?php echo $key; ?>"</i> did not match anything.<br/>
          <b>Did you mean: </b>
          <a href="./questions.php?key=<?php echo $suggestionU; ?>"><?php echo $suggestion; ?></a>
          <span style="font-size:25px">?</span>
        </div>
      </div>
    </div>
    <div class="span3 suggestion">
      <h4>May also mean</h4>
      <ul>
        <?php
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
})
$('.brand').mouseout(function(){
  $('.brand img').attr('src','./danbo.png');
})
</script>