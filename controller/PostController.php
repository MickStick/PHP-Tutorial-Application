<?php
        session_start();
        $Post = new \stdClass();;
        //$Post->body = explode('\n',$_REQUEST["post"]);
        $Post->body = $_REQUEST["post"];
        //$Post->body = str_replace("\n", '---',$Post->body);
        $Post->name= $_SESSION["username"];
        $Post->face = $_SESSION["propic"];

        $post = json_encode($Post);
        echo  $post;
    
?>