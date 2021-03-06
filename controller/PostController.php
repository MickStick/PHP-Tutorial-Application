<?php
        session_start();
        include '../model/DBConfig.php';
        //
        if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_REQUEST["pid"])){
                        $post_id = $_REQUEST["pid"];
                        $post = $_REQUEST["post"];
                        $sql = "UPDATE posts SET body='$post' WHERE post_id = '$post_id'";
                        if($conn->query($sql)){
                                $Post = new \stdClass();
                                $Post->message = "UPDATED"; 
                                $Post->body = "Post updated";
                                // $post[0] = $Post;
                                // echo  $data = json_encode($post); 
                                $post = json_encode($Post);
                                echo  $post; 
                                $conn->close;
                        }else{
                                $Post = new \stdClass();
                                $Post->message = null; 
                                $Post->body = "Update Failed: ".$conn->error;
                                // $post[0] = $Post;
                                // echo  $data = json_encode($post); 
                                $post = json_encode($Post);
                                echo  $post; 
                                $conn->close;
                        }   
                }else if(isset($_REQUEST["cid"])){
                        $post_id = $_REQUEST["pid"];
                        $comment_id = $_REQUEST["cid"];
                }else if(isset($_REQUEST["lid"])){
                        
                }else{
                        $post_id = ($_SESSION["id"]  *  pow(10,(strlen($_SESSION["posts"] + 1)))) + ($_SESSION["posts"] + 1);
                        $_SESSION["posts"]++;
                        $id = $_SESSION["id"];
                        $fname = $_SESSION["fname"];
                        $lname = $_SESSION["lname"];
                        $body = $_POST["body"];//$_REQUEST["post"];
                        $dir = "../public/static/";
	                $file = $dir.basename($_FILES["file"]["name"]);
	                $Type = "";
	                $pic = "";
	                if(isset($_FILES["file"])){
	                        $Type = pathinfo($file,PATHINFO_EXTENSION);
	                        $pic = $dir .$post_id. "_".$_SESSION["username"].".".$Type;   
	                }else{
	                        $pic = "";   
	                }
                        date_default_timezone_set("UTC");
                        $post_date = date("Y-m-d H:i:s");
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
                                if(isset($_FILES["file"])){
                                        if (move_uploaded_file($_FILES["file"]["tmp_name"], $pic)) {
                                               $Post->pic = $pic;
                                        }else{
                                            $Post->pic = "";     
                                        }
                                }else{
                                      $Post->pic = "";  
                                }
                               
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
                }
                
                
        }else if($_SERVER["REQUEST_METHOD"] == "GET"){
                if($_REQUEST["type"] == 0){
                        $id = $_SESSION["id"];
                        $results = $conn->query("SELECT * FROM posts WHERE id = '$id' ORDER BY post_date ASC");
                        
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
                                        $Post->pic = $res["picture"];
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
                }else if($_REQUEST["type"] == 2){
                        $id = $_SESSION["pid"];
                        $results = $conn->query("SELECT * FROM posts WHERE id = '$id' ORDER BY post_date ASC");
                        $propic = $conn->query("SELECT * FROM users WHERE id = '$id'");
                        $pic = $propic->fetch_assoc();
                        $post = array();
                        $x = 0;
                        if($results->num_rows > 0){
                                while($res = $results->fetch_assoc()){
                                        $Post = new \stdClass();
                                        $Post->post_id = $res["post_id"];
                                        $Post->body = $res["body"];
                                        $Post->name = $res["fname"] . " " . $res["lname"];
                                        $Post->face = $pic["propic"];
                                        $Post->date = $res["post_date"];
                                        $Post->pic = $res["picture"];
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
                
        }else if($_SERVER["REQUEST_METHOD"] == "DELETE"){
                $post_id = $_REQUEST["pid"];
                $sql = "DELETE FROM posts WHERE post_id = '$post_id'";
                if($conn->query($sql)){
                        $Post = new \stdClass();
                        $Post->message = "DELETED"; 
                        $Post->body = "Post deleted";
                        $post[0] = $Post;
                        echo  $data = json_encode($post); 
                        $conn->close;
                }else{
                        $Post = new \stdClass();
                        $Post->message = null; 
                        $Post->body = "Delete Failed: ".$conn->error;
                        $post[0] = $Post;
                        echo  $data = json_encode($post); 
                        $conn->close;
                }
        }else if($_SERVER["REQUEST_METHOD"] == "PUT"){
                
        }
    
?>