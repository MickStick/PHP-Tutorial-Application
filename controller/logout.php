<?php
    session_start();
    include '../model/DBConfig.php';
    $posts = $_SESSION["posts"];
    $id = $_SESSION["id"];
    if($conn->query("UPDATE users SET posts='$posts' WHERE id = '$id'") == true){
        session_destroy();
        $res = "Over";
        echo $res;
    }else{
        
        echo null;
    }
    
?>