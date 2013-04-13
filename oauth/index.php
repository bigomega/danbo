<?php

session_start();

if (isset($_POST["user"]) && isset($_POST["pass"])) {
	$user = $_POST["user"];
	$pass = $_POST["pass"];
	$db = json_decode(file_get_contents(".db"));

	if(property_exists($db->{'user'}, $user) == false){
    header('location: ../error.php?user=1');
    exit();
  }

  if($db->{'password'}->{$user} != md5($pass)) {
    header('location: ../error.php?pass=1');
    exit();
  }

  $_SESSION["logged"] = true;
  $_SESSION["user"] = $user;
  $_SESSION["uimage"] = $db->{'user'}->{$user}->{'image'};

  header('location: ../');
  exit();

} else {
    header('location: ../error.php');
    exit();
}

// {
// 	"users": [],
// 	"password" : [],
// 	"preference" : {}
// }

?>