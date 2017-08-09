<div class="FormContainer">
    <label id="goreg"> Register </label>
    <label id="golog"> Login </label>
    <form class="loginForm" method = "POST" action="/">
        <table>
            <tr><td><label for="uname">Username</label></td><td><input type="text" name="uname" placeholder="Username"/></td></tr>
            <tr><td><label for="pword">Password</label></td><td><input type="password" name="pword" placeholder="password"/></td></tr>
        </table>
        <button type="submit" id="logBtn" name="login">Login</button>  
        <?php
            if(isset($_SESSION["status"])){
                if(isset($_SESSION["log"])){
                    if(!$_SESSION["log"]){?>
                    <p style="color: red"> <?php echo $_SESSION["message"]; ?></p><?php
                    }
                }
            }
        ?>

    </form>
</div>


