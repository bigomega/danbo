<?php
session_start();

if (isset($_SESSION['logged']) && isset($_GET['type'])) {
	$db = json_decode(file_get_contents(".db"));
	$url = "./default_profile_image.gif";

	if ($_GET['type']=="Facebook") {
		$url = "https://graph.facebook.com/".$_GET['id']."/picture?width=200&height=200";
	} elseif ($_GET['type']=="Twitter") {
		$url = "https://api.twitter.com/1/users/profile_image/".$_GET['id']."?size=bigger";
	}
	
	$_SESSION['uimage'] = $url;
	$db->{'user'}->{$_SESSION['user']}->{'image'} = $url;


	file_put_contents(".db", json_encode($db));
	
  header('location: ../profile.php');
  exit();
} else {
  header('location: ../');
  exit();
}


?>