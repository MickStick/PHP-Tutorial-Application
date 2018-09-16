<?php
    include "controller/MainController.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <?php $title = "PHP Tutorial Application | Home"; include "partials/head.php"; ?>
    </head>
    
    <header>
        <?php include "partials/header.php" ?>
    </header>
    
    <body>
        <main>
            <h1 style="width: 70%; margin: 45vh auto; text-align: center"> Yo <?php echo $_SESSION["fname"]. " ". $_SESSION["lname"];?> So like.. This should be the home page but..
            <br> I like kinda did get around to finishing this, bruh. 😅
            <br> See you next two months or so, yeh.</h1>
        </main>
    </body>
    
     <footer>
        <?php include "partials/footer.php"; ?>
    </footer>
</html>