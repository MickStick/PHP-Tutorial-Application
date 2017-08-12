<?php
	include 'model/DBConfig.php';
	$dir = "public/static/";
	$file = $dir.basename($_FILES["file"]["name"]);
	$_SESSION["message"] = "File name: ".$file;
	$propic = "";
	$fileName = "";
	$Type = "";
	if(basename($_FILES["file"]["name"]) != "" | basename($_FILES["file"]["name"]) != null){
		$Type = pathinfo($file,PATHINFO_EXTENSION);
		$files = scandir ($dir);
		$x = 0;
		$count = 0; 
		/*$_SESSION["files"] = $files;
		header("location: /message.php");*/
		for($x = 0; $x < sizeof($files); $x++){
			if(strpos($files[$x], $_SESSION["username"]) !== false){
				$count++;
			}
		}

		$count+=1;
		$propic = "public/static/ProPic_".$_SESSION["username"]."_0".$count.".".$Type;
		$fileName = "ProPic_".$_SESSION["username"]."_0".$count.".".$Type;
	}else{
		$propic = $_SESSION["propic"];
	}

	if($_POST["fname"] != "" || $_POST["fname"] != null){
		$fname = $_POST["fname"];
	}else{
		$fname = $_SESSION["fname"];
	}

	if($_POST["lname"] != "" || $_POST["lname"] != null){
		$lname = $_POST["lname"];
	}else{
		$lname = $_SESSION["lname"];
	}

	if($_POST["email"] != "" || $_POST["email"] != null){
		$email = $_POST["email"];
	}else{
		$email = $_SESSION["email"];
	}
	$id = $_SESSION["id"];
	
	$sql = "UPDATE users SET fname='$fname', lname='$lname', propic='$propic', email='$email' WHERE id = $id ";
	
	if($conn->query($sql) === TRUE){
		if($_SESSION["propic"] != $propic){
			//$saveTo = $dir $fileName;
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $dir . $fileName)) {
        			echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
				$_SESSION["propic"] = $propic;
				$_SESSION["fname"] = $fname;
				$_SESSION["lname"] = $lname;
				$_SESSION["email"] = $email;
				header("location: /profile.php");
    			} else {
        			echo "Sorry, there was an error uploading your file.";	
				$_SESSION["message"] = $_SESSION["message"]. "\nSorry, there was an error uploading your file: ".basename( $_FILES["file"]["name"]).".";
				header("location: /message.php");
    			}
		}else{
			$_SESSION["propic"] = $propic;
			$_SESSION["fname"] = $fname;
			$_SESSION["lname"] = $lname;
			$_SESSION["email"] = $email;
			header("location: /profile.php");
		}
		
	}else{
		$_SESSION["message"] = $conn->error;
		header("location: /message.php");
	}
	$conn->close();

?>