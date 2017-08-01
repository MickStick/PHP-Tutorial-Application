<?php
    include 'model/DBConfig.php';
    include 'model/Users.php';
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        require 'LoginController.php';
        if($_SESSION["status"] != null){
            header("location: profile.php");
        }else{
            echo $_SESSION["message"];
            header("location: message.php");
        }
      
       
       /*if($users!= null){
           echo $users;
        header("location: view/profile.php");
       }else{
       // header("location: view/");
        header("location: view/profile.php");
       }*/
    }


    
?>