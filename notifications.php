<div class="Notification-Container">
    <?php
        include "model/DBConfig.php";
        $id = $_SESSION["id"];
        $notifs = $conn->query("SELECT * FROM notifications WHERE id = '$id'");
        
        while($notif = $notifs->fetch_assoc()){?>
            <div class="Notification" data-id="<?php echo $notif["nid"];?>" 
            <?php if($notif["status"] == null){?>
                data-status="unread"
            <?php
            }?>
            data-type="<?php echo $notif["type"];?>">
                <p <?php 
                    if($notif["fid"] != null){
                        ?>data-id="<?php echo $notif["fid"];?>"<?php
                    }else if($notif["post_id"] != null){?>
                        data-id="<?php echo $notif["post-id"];?>"
                    <?php
                    }
                ?>> <?php echo $notif["body"];?></p>
            </div><?php
        }
    ?>
</div>
