<?php
    include "controller/MainController.php";
    $title = "Find People";
    include 'model/DBConfig.php';
    include 'model/SResults.php';
    $search = strtolower($conn->escape_string($_GET["hsearch"]));
    $x = 0;
    $People = new SResults();
    $names = $conn->query("SELECT id,username,fname,lname, email, propic FROM users");
    if($names->num_rows > 0){
        
        
        while($name = $names->fetch_assoc()){
            if(strtolower($name["fname"]). " " .strtolower($name["lname"]) == $search || strtolower($name["fname"]) == $search || strtolower($name["lname"]) == $search || strtolower($name["username"]) == $search || strtolower($name["email"]) == $search){
                $People->setID($x,$name["id"]);
                $People->setFname($x,$name["fname"]);
                $People->setLname($x,$name["lname"]);
                $People->setProPic($x,$name["propic"]);
                $x+= 1;
            }
        }
        if(sizeof($People->id) == 0){
            $People->setID(0,1);
            $People->setFname(0,"Nobody");
            $People->setLname(0,"Found");
            $People->setPropic(0,"public/static/BaseProPic.png");
        }
    }else{
        $People->setFname(0,"Query");
        $People->setLname(0,"Failed");
    }
    $conn->close();
    
    
?>

<!DOCTYPE = html5>
<html>
    <head>
        <?php include "partials/head.php"?>
    </head>
    <header>
        <?php include "partials/header.php"?>
    </header>
    
    <body>
        <main id="find-people-View">
            <div class="FoundPeopleContainer">
                <label> People Found</label>
                <div class="PeopleFound">
                    <?php
                        
                        for($y = 0; $y < sizeof($People->id); $y++){?>
                            <div id="foundPerson" data-id="<?php include "model/Users.php"; echo Users::ConvPWD($People->getID($y));?>">
                                <img src="<?php echo $People->getProPic($y)?>"></img>
                                <label> <a <?php if($People->getFname($y) == "Nobody" || $People->getFname($y) == $_SESSION["fname"]){
                                        echo 'href="profile.php"';
                                    } else {
                                        echo 'href="peopleProfile.php?id='.Users::ConvPWD($People->getID($y)).'"';
                                    } ?> ><?php echo $People->getFname($y)." ".$People->getLname($y);?></a></label>
                                <?php if($People->id[$y] == 1 || $People->getID($y) == $_SESSION["id"]){
                                    
                                }else{?>
                                    <button id="addFriend" name="addFriend">Add Friend</button>
                                    <?php
                                
                                }?>
                                
                            </div><?php
                        }
                        
                    ?>
                </div>
                
            </div>
            
        </main>
    </body>
    <footer>
        <?php include "partials/footer.php"; ?>
    </footer>
</html> 