<?php
require 'controller/MainController.php';
?>
<!DOCTYPE html>
<html lang="en">
    <?php $title = "Login"; ?>

    <head>
        <?php
        include 'partials/head.php';
        ?>        
    </head>
    

    <body>
        <main id="login-view">
            <?php
            include 'login.php';
            ?> 
        </main>
    </body>

</html>

