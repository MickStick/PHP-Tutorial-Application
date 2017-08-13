<?php
        session_start();
        include '../model/DBConfig.php';
        //
        if($_SERVER["REQUEST_METHOD"] == "POST"){
                $post_id = ($_SESSION["id"]  *  pow(10,(strlen($_SESSION["posts"]) + 1))) + $_SESSION["posts"] + 1;
                $_SESSION["posts"] += 1;
                $id = $_SESSION["id"];
                $fname = $_SESSION["fname"];
                $lname = $_SESSION["lname"];
                $body = $_REQUEST["post"];
                $pic = $_REQUEST["pic"];
                $post_date = date("m.d.Y");
                $sql = "INSERT INTO posts (post_id,id, fname, lname, body, picture, post_date) VALUES ('$post_id','$id', '$fname','$lname', '$body', '$pic','$post_date')";
                if(!$conn->query($sql)){
                        $Post = new \stdClass();
                        $Post->body = $conn->error;
                        $Post->message = null;
                        $post = json_encode($Post);
                        echo  $post;  
                        $conn->close;
                }else{
                        $Post = new \stdClass();
                        $Post->post_id = $post_id;
                        $Post->body = $body;//$_REQUEST["post"];
                        $Post->name = $_SESSION["fname"]. " " . $_SESSION["lname"];
                        $Post->face = $_SESSION["propic"];
                        $Post->date = $post_date;
                        $Post->message = "Saved";
                        $Post->posts = $_SESSION["posts"];
                        $Post->post = $_SESSION["post"];
        
                        $post = json_encode($Post);
                        $post_num = $_SESSION["posts"];
                        if($conn->query("UPDATE users SET posts='$post_num' WHERE id='$id'")){
                                echo  $post;  
                                $conn->close;     
                        }
                        
                }
                
        }else if($_SERVER["REQUEST_METHOD"] == "GET"){
                if($_REQUEST["type"] == 0){
                        $id = $_SESSION["id"];
                        $results = $conn->query("SELECT * FROM posts WHERE id = '$id'");
                        
                        $post = array();
                        $x = 0;
                        if($results->num_rows > 0){
                                while($res = $results->fetch_assoc()){
                                        $Post = new \stdClass();
                                        $Post->post_id = $res["post_id"];
                                        $Post->body = $res["body"];
                                        $Post->name = $res["fname"] . " " . $res["lname"];
                                        $Post->face = $_SESSION["propic"];
                                        $Post->date = $res["post_date"];
                                        $Post->message = "Found";  
                                        $post[$x] = $Post; 
                                        $x += 1;                         
                                }
                                echo  $data = json_encode($post); 
                                $conn->close;
                                 
                        }else{
                                $Post = new \stdClass();
                                $Post->message = null; 
                                $Post->body = "No Posts Found";
                                $post[0] = $Post;
                                echo  $data = json_encode($post); 
                                $conn->close;
                        }
                }else{
                        echo "else";
                        $conn->close;
                }
                
        }
    
?>