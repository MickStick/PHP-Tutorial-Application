<?php
include "model/Users.php";
include 'model/DBConfig.php';

        $users = $conn->query("SELECT * FROM users");
        if($users->num_rows > 0){
            $userCount = $users->num_rows;
        }else{
            $userCount = 0;
        }

        $id = 100000 + $userCount;
        $uname = $_POST["uname"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $pword = Users::convPWD($_POST["pword"]);

        $usql = ("INSERT INTO users (id,username,fname,lname,propic,email,posts) 
        VALUES ('$id','$uname','$fname','$lname','','$email',0)");

        $psql = ("INSERT INTO user_pwds (id,password) 
        VALUES ('$id','$pword')");

        if(!$conn->query($usql)){
            //header("location: /signup.php");
            echo "FAILED! "  .$conn->error;
        }else{
            if(!$conn->query($psql)){
                //header("location: /signup.php");
                echo "PASSWORD FAILED! "  .$conn->error;
            }else{
                $_SESSION["status"] = "Registered";
                $_SESSION["message"] = "Register Successful";
                $_SESSION["log"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $uname;
                $_SESSION["fname"] = $fname;
                $_SESSION["lname"] = $lname;
                $_SESSION["email"] = $email;
                $_SESSION["propic"] = null;
                $_SESSION["post"] = 0;
                $_SESSION["posts"] = 0;

                header("location: /profile.php");
            }
        }
    
?>