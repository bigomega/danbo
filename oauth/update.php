<?php
session_start();

if (isset($_SESSION['logged']) && isset($_GET['key'])) {
	$user = $_SESSION["user"];
	$db = json_decode(file_get_contents(".db"));

	if(property_exists($db->{'user'}, $user) == false){
    header('location: ../error.php?user=1');
    exit();
  }
	
  $newScore = array('name' => $_GET['key'], 'score' => $_GET['score'], 'total' => $_GET['total']);
  array_push($db->{'user'}->{$user}->{'score'}, $newScore);
	file_put_contents(".db", json_encode($db));

	// header('location: ../');
	// exit();
}

// header('location: ../login.php');
// exit();
?>