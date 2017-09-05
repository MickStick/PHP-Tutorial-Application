<!DOCTYPE html>
<?php
require 'controller/MainController.php';
$title = $_SESSION["fname"]. " " .$_SESSION["lname"];

if($_SESSION["propic"] == "" || $_SESSION["propic"] == null){
    $_SESSION["propic"] = "public/static/BaseProPic.png";
}

?>

<html lang="en">
        <head>
            <?php
            include 'partials/head.php';
            ?>        
            <!--<script src="public/script/fetchPerPosts.js"></script>-->
        </head>
    <header>
        <?php
        include 'partials/header.php';
        ?> 
    </header>
    <body>
        <main id="profile-view">
            <div class="profile-partition">
                <p style="color: transparent">Just cuz if dis empty it nah guh show</p>
            </div>
            <div class="profile-partition" id="middle-partition">
                <div class="ToPost-Container">
                    <form method = "POST" action="profile.php" enctype="multipart/form-data">
                        <textarea rows="20" name="post" 
                        placeholder="What's going on in your brain right now?" 
                        ></textarea><!-- data-emojiable="true"-->
                        <button name="makePost" type="submit" id="makePost"><i class="material-icons">add</i></button>
                        <h6 id="emojiBtn"><i class="material-icons">insert_emoticon</i></h6>
                        <label for="photo_posts"><i class="material-icons">add_a_photo</i></label>
                        <input type="file" id="photo_posts" accept=".png,.jpg," />
                    </form>
                </div>
                <hr>
                <div class="Post-Container" id="postContainer" style="width: 100%; height: auto; padding: 2px 0px;">
                    
                </div>

                
            
            </div>
            <div class="profile-partition">
                <img src="<?php echo $_SESSION["propic"];?>" alt="Profile Face" id="UserProPic">
                <label id="UserName"><?php echo $_SESSION["fname"]. " " .$_SESSION["lname"]; ?></label>
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
