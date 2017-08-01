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
        </main>
    </body>
</html>
