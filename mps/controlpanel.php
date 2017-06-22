<?php

	$status = file_get_contents("status.txt");
		
	// $status_text for debugging when needed
	if($status == 0){
		$status_text = "Website is currently not under attack";
	}else if($status == 1){
		$status_text = "Website is currently locked under Ransomware Attack";
	}else{
		$status_text = "Status is not detected";
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Control Panel for MPS</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript">
			function attackWebpage(typeOfAttack){
				$.ajax({
					url:"requestProcessor.php",
					type: "POST",
					data: {action: "attack" , attackType: typeOfAttack},
					success:function(){
						document.getElementById("notUnderAttack").style.display = "none";
						document.getElementById("underAttack").style.display = "unset";
					}
				});
			}
			
			function resetWebpage(){
				$.ajax({
					url:"requestProcessor.php",
					type: "POST",
					data:{action: "reset"},
					success:function(){
						document.getElementById("notUnderAttack").style.display = "unset";
						document.getElementById("underAttack").style.display = "none";
					}
				});
				
			}
		</script>
	</head>
	<body>
		<h1>Malicious Plugin Simulator Control Panel</h1>
		
		<div id="notUnderAttack" <?php if($status != 0) echo 'style="display:none;"';?>>
			Page is currently not under attack
			
			<style type="text/css">
			table.example2 {background-color:transparent;border-collapse:collapse;width:80%;}
			table.example2 th, table.example2 td {text-align:center;border:1px solid black;padding:5px;}
			table.example2 th {background-color:AntiqueWhite;}
			table.example2 td:first-child {width:20%;}
			</style>
			<table class="example2">
				<tr>
					<th>Scenerios</th><th>Description</th>
				</tr>
				<tr>
					<td><button onclick="attackWebpage('1')" id="buttonRansomware" class="float-left submit-button" >Trigger CTB-Locker</button></td>
					<td>Ransomware Attack
					<br />
					1) Drops necessary files into web-server
					<br />
					2) Send a HTTP POST request to trigger the Ransomware Encryption					
					</td>
				</tr>
			</table>
		</div>
		<div id="underAttack" <?php if($status == 0) echo 'style="display:none;"';?>>
			Page is currently under attack
			<br />
			<br />
			<button onclick="resetWebpage()" id="reset">Reset Website</button>
		</div>

	</body>
</html>