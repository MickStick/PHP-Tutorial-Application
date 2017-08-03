<?php

function convID($id){
    $convid = hash('sha256',$id);
    return $convid;
}

function convPWD($pwd){
    $PWD = hash('sha256',$pwd);
    return $PWD;
}

        $user = "";
        $uname =  $conn->escape_string($_POST["uname"]);//mysqli_real_escape_string($conn, $_POST["uname"]);
        $pword =   $conn->escape_string($_POST["pword"]);//mysqli_real_escape_string($conn, $_POST["pword"]);
        /*$results = mysqli_query($conn,"SELECT * FROM users WHERE username = '$uname'");*/
        $results = $conn->query("SELECT * FROM users WHERE username = '$uname'");
        $stat = mysqli_num_rows($results);
        if($results->num_rows > 0){
            $user = $results->fetch_assoc();//mysqli_fetch_array($results,MYSQLI_ASSOC);
            $id = $user["id"];
            $pwdresults = mysqli_query($conn,"SELECT * FROM user_pwds WHERE id = '$id'");
            $user_pwd = mysqli_fetch_array($pwdresults,MYSQLI_ASSOC);
            $pwd = convPWD($pword);
            //print "db password: " .$user_pwd["password"] . ", inputted password: " .$pwd . ", raw password: " .$pword;
            if($user_pwd["password"] == $pwd){
                $_SESSION["status"] = "logged in";
                $_SESSION["message"] = "User Found";
                $_SESSION["id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["fname"] = $user["fname"];
                $_SESSION["lname"] = $user["lname"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["propic"] = $user["propic"];
            }else{
                $_SESSION["status"] = null;
                $_SESSION["message"] = "Username or Password incorrect";
            }
            
        }else{
            $_SESSION["status"] = null;
            $_SESSION["message"] = "User not found";
        }

 

?>