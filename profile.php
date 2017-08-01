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
            <img src="<?php echo $_SESSION["propic"];?>" alt="face">
            <h1>Shaw's username is <?php echo $_SESSION["username"];?></h1>
            <p>
                <?php
                    $propicAppend = "";
                    for($x = 0; $x < 3; $x++){ 
                        parse_str( $propicAppend .= $_SESSION["id"][strlen($_SESSION["id"]) - ($x+1)]); 
                    }
                    echo $propicAppend;
                ?>
            </p>
        </main>
    </body>
</html>
