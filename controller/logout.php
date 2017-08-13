<?php
    /*include '../model/DBConfig.php';
    $posts = $_SESSION["posts"];
    $id = $_SESSION["id"];
    if($conn->query("UPDATE users SET posts='$posts' WHERE id = '$id'") === TRUE){
        session_destroy();
        $res = "Over";
        echo $res;
        $conn->close;
    }else{
        
        echo null;
        $conn->close;
    }*/
    session_start();
    setcookie(session_name(), '', 100);
    session_unset();
    session_destroy();
    $_SESSION = array();
    header("location: /index.php");
    
?>