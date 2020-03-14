<?php
	
	error_reporting(0);
	include "includes/header.php";

	require_once __DIR__ . '/vendor/autoload.php';

	if(isset($_GET['view'])){
		if($_GET['view'] == 'login'){
			include "includes/login.php";
		}elseif($_GET['view'] == 'download_file'){
			include "includes/download_file.php";
		}
	}else{
		include "includes/register.php";
	}


	include "includes/footer.php";

?>