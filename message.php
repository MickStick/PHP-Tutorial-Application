<?php
    include 'controller/MainController.php';
    //print_r($_SESSION["files"]);
	//echo sizeof($_SESSION["files"]);
	/*$x = 0;
	$count = 0;
	for($x = 0; $x < sizeof($_SESSION["files"]); $x++){
		if (strpos($_SESSION["files"][$x], $_SESSION["username"]) !== false) {
    			$count++;
			echo $_SESSION["username"]."\n";
			echo $_SESSION["files"][$x];
		}

	}
	echo $count;*/
	echo $_SESSION["message"];
?>