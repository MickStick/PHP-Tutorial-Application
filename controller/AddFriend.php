<?php
    session_start();
    include "../model/Users.php";
    include "../model/DBConfig.php";   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_REQUEST["type"] == "add"){
            $fid = $_SESSION["id"];
            $body = "".$_SESSION["fname"]. " " . $_SESSION["lname"]." has sent you a Freind Request.";
            $idresults = $conn->query("SELECT * FROM users");
            $find = false;
            while($ID = $idresults->fetch_assoc()){
                $tem1 = ''.$_REQUEST["fid"];
                $tem2 = ''.Users::ConvPWD($ID["id"]);
                if($tem1 == $tem2){
                    $id = $ID["id"];
                    
                    $sql = "INSERT INTO notifications (id,type,fid,body) VALUES ('$id','Friend Request','$fid','$body')";
                    
                    if(!$conn->query($sql)){
                        $data = null;
                    }else{
                        $data = "Added";
                    }
                    $find = true;
                    break;
                }
                
                
            }
           if($find){
               echo $data;
           }else{
               $data = null;
               echo $data;
           }
            
        }
    }else{
    }
?>