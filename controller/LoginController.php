<?php
include 'model/DBConfig.php';
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
                $notifs =  $conn->query("SELECT * FROM notifications WHERE id = '$id'");
                $_SESSION["status"] = "logged in";
                $_SESSION["log"] = true;
                $_SESSION["message"] = "User Found";
                $_SESSION["id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["fname"] = $user["fname"];
                $_SESSION["lname"] = $user["lname"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["propic"] = $user["propic"];
                $_SESSION["post"] = $user["posts"];
                $_SESSION["posts"] = $user["posts"];
                $_SESSION["notif_count"] = $notifs->num_rows;
                $x = 0;
                if($notifs->num_rows > 0){
                    while($notif = $notifs->fetch_assoc()){
                        $_SESSION["notifs"][$x] = $notif;
                        $x++;
                    }
                    
                }else{
                    $_SESSION["notifs"] = null;
                }
                $conn->close;
                header("location: profile.php");
            }else{
                $_SESSION["status"] = "login failed";
                $_SESSION["log"] = false;
                $_SESSION["message"] = "Username or Password incorrect";
                $conn->close;
            }
            
        }else{
            $_SESSION["status"] = "login failed";            
            $_SESSION["log"] = false;
            $_SESSION["message"] = "Username or Password incorrect";
            $conn->close;
        }
     
        

 

?>