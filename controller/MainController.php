<?php

    
    session_start();
    /*else{
        
    }*/
    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['login'])){
            require 'LoginController.php';
            
        }else if(isset($_POST['register'])){
            require 'RegisterController.php';
        }else if(isset($_POST['edit'])){
		require 'UpdateProfile.php';
	}
    }else if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["uname"])){
            include '../model/DBConfig.php';
            $uname = $_REQUEST["uname"];
            $name = $conn->query("SELECT * FROM users WHERE username = '$uname'");
            if($name->num_rows > 0){
                $data = true;
            }else{
                $data = false;
            }
            $conn->close();
            echo $data;
        }else{
            if($_SERVER['REQUEST_URI'] == "/" ||  $_SERVER['REQUEST_URI'] == "/signup.php"){
                if(isset($_SESSION["status"])){ 
                    if($_SESSION["log"]){
                        header("location: /profile.php");
                    }
                    
                }
                
            }else{
                if(!isset($_SESSION["status"])){
                    header("location: /");
                }else if(!$_SESSION["log"]){
                    header("location: /");
                }
            }
        }
    }
    


    
?>