<?php
session_start();
if(isset($_SESSION['logged'])){
  header('location: ../profile.php');
  exit();
}

if (isset($_POST['user']) && isset($_POST['pass'])) {
	$user = $_POST["user"];
	$pass = $_POST["pass"];
	$db = json_decode(file_get_contents(".db"));
	if(property_exists($db->{'user'}, $user) == false){
		$db->{'user'}->{$user} = array("image" => "./danbo.png", "score" => array());
		$db->{'password'}->{$user} = md5($pass);
		file_put_contents(".db", json_encode($db));
		$_SESSION['user'] = $user;
		$_SESSION['uimage'] = './danbo.png';
		$_SESSION['logged'] = true;
  }
  else {
		header('location: ../error.php?user=2');
		exit();
  }
}

header('location: ../');
exit();
?>