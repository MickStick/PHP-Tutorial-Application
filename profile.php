<?php
require 'controller/MainController.php';
$title = $_SESSION["fname"]. " " .$_SESSION["lname"];
?>
<!DOCTYPE html>
<html lang="en">
        <head>
            <?php
            include 'partials/head.php';
            ?>        
        </head>
    <header>
        <?php
        include 'partials/header.php';
        ?> 
    </header>
    <body>
        <main id="profile-view">
            <div class="profile-partition">
                
            </div>
            <div class="profile-partition" id="middle-partition">
                <div class="ToPost-Container">
                    <form>
                        <textarea name="post" placeholder="What's on you mind?"></textarea>
                        <button type="submit"><i class="material-icons">add</i></button>
                    </form>
                </div>
                <hr>
            
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
</html>
