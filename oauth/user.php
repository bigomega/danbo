<?php
if(isset($_GET['name'])){
	$user = $_GET["name"];
	$db = json_decode(file_get_contents(".db"));
	
	if($user == ""){
		echo json_encode(array("avail" => false));
    exit();
  }

	if(property_exists($db->{'password'}, $user) == false){
		echo json_encode(array("avail" => true));
    exit();
  }
  echo json_encode(array("avail" => false));	
} else {
	echo json_encode(array("avail" => false));
}
?>