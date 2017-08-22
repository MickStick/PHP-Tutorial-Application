
<title>
    <?php 
        if(isset($_SESSION["notif_count"])){
            if($_SESSION["notif_count"] > 0){
                echo "(".$_SESSION["notif_count"].") ". $title;
            }else{
                echo $title;
            }
             //echo "(".$_SESSION["notif_count"].") ". $title;
        }else{
            echo $title;
        }
        
    ?>
</title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="author" content="Mikhail Rene Shaw">
<meta name="description" content="Application for testing and practicing PHP">
<meta name="keywords" content="HTML,CSS,JavaScript,PHP,social meadia, mikhail shaw, Mikhail Shaw, phptutorial01, shaw phptutorial">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
<link rel="shortcut icon" href="favicon.png">
<link rel="stylesheet" type="text/css" href="public/style/jquery.emojipicker.css">
<link rel="stylesheet" type="text/css" href="public/style/jquery.emojipicker.tw.css">
 <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">-->
 <!--<link href="public/style/emoji.css" rel="stylesheet">-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="public/style/style.css" rel="stylesheet">
<script src="public/script/jquery.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="public/script/jquery.emojipicker.js"></script>
<script type="text/javascript" src="public/script/jquery.emojis.js"></script>
<!--<script src="public/script/jQueryEmoji.js"></script>-->
<!--  <script src="public/script/config.js"></script>-->
<!--  <script src="public/script/util.js"></script>-->
<!--  <script src="public/script/jquery.emojiarea.js"></script>-->
<!--  <script src="public/script/emoji-picker.js"></script>-->
<script src="public/script/script.js"></script>
