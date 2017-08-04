<?php
    include 'model/DBConfig.php';
    include 'model/Users.php';
    
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['login'])){
            require 'LoginController.php';
            header("location: profile.php");
        }else if(isset($_POST['makePost'])){
        }
        /*if($_SERVER["REQUEST_METHOD"] == "GET"){
            if(isset($_POST['makePost'])){
                echo "pressed";
            }
        }*/
       
      
       
       /*if($users!= null){
           echo $users;
        header("location: view/profile.php");
       }else{
       // header("location: view/");
        header("location: view/profile.php");
       }*/
    }
    


    
?>