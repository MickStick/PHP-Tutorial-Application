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
                        include "model/DBConfig.php";
                        $notifs =  $conn->query("SELECT * FROM notifications WHERE id = '$id' and status == 'null'");
                        $_SESSION["notif_count"] = $notifs->num_rows;
                        if($notifs->num_rows > 0){
                            $x = 0;
                            while($notif = $notifs->fetch_assoc()){
                                $_SESSION["notifs"][$x] = $notif;
                                $x++;
                            }
                        }else{
                            $_SESSION["notifs"] = null;
                        }
                
                        $conn->close;
                        header("location: /profile.php");
                    }
                    
                }
                
            }else if( $_SERVER['REQUEST_URI'] == "/index.php" || $_SERVER['REQUEST_URI'] == "/findPeople.php"){
                 header("location: /");
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