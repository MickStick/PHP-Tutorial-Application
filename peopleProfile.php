<!DOCTYPE html>
<?php
require 'controller/MainController.php';
include "model/DBConfig.php";
include "model/Users.php";
$pid = urldecode($_GET["id"]);
$Person = new Users;
$result = $conn->query("SELECT * FROM users");
if($result->num_rows > 0){
    while($user = $result->fetch_assoc()){
        
        $tem1 = ''.$_REQUEST["id"];
        $tem2 = ''.Users::ConvPWD($user["id"]);
        if($tem1 == $tem2 /*$_REQUEST["id"] == Users::ConvPWD($user["id"])*/){
            /* Users::ConvPWD($user["id"]) ."\n";
            echo $_REQUEST["id"];*/
            $Person->setID($user["id"]);
            $_SESSION["pid"] = $user["id"];
            $Person->setUsername($user["username"]);
            $Person->setFname($user["fname"]);
            $Person->setLname($user["lname"]);
            $Person->setEmail($user["email"]);
            if($user["propic"] != "" || $user["propic"] != null){
                $Person->setProPic($user["propic"]);
            }else{
                $Person->setProPic("publuc/static/BaseProPic.png");
            }
            break;
        }
    }
}else{
    header ("location: /");
}
$conn->close;

$title = $Person->getFname(). " " .$Person->getLname();

?>
<html lang="en">
        <head>
            <?php
            include 'partials/head.php';
            ?>        
            <!--<script src="public/script/fetchPerPosts.js"></script>-->
            <script type="text/javascript" >
                function hello(){
                    alert('hello');
                }
            </script>
        </head>
    <header>
        <?php
        include 'partials/header.php';
        ?> 
    </header>
    <body id="PeopleProfile">
        <main id="profile-view" >
            <div class="profile-partition">
                <p style="color: transparent">Just cuz if dis empty it nah guh show</p>
            </div>
            <div class="profile-partition" id="middle-partition">
                <div class="ToPost-Container">
                    <form method = "POST" action="profile.php">
                        <textarea rows="20"name="post" placeholder="What's going on in your brain right now?    "></textarea>
                        <button name="makePost" type="submit"><i class="material-icons">add</i></button>
                    </form>
                </div>
                <hr>
                <div class="Post-Container" id="postContainer" style="width: 100%; height: auto; padding: 2px 0px;">
                    
                </div>

                
            
            </div>
            <div class="profile-partition">
                <img src="<?php echo $Person->getProPic();?>" alt="Profile Face" id="UserProPic">
                <label id="UserName"><?php echo $Person->getFname(). " " .$Person->getLname(); ?></label>
            </div>
            
           <!-- <h1><?php echo $_SESSION["lname"];?>'s username is <?php echo $_SESSION["username"];?></h1>
            <p>
                <?php
                    $propicAppend = "";
                    for($x = 0; $x < 3; $x++){ 
                        parse_str( $propicAppend .= $_SESSION["id"][strlen($_SESSION["id"]) - ($x+1)]); 
                    }
                    echo $propicAppend;
                ?>
            </p>-->
        </main>
    </body>
    <footer>
    <?php include "partials/footer.php"; ?>
    </footer>
</html>



