<div class="FormContainer" id="reg">
    <label id="goreg"> Register </label>
    <label id="golog"> Login </label>
    <form class="loginForm" method = "POST" action="/signup">

    <table>
        <tr><td><label for="uname">Username</label></td><td><input id="uname" type="text" name="uname" placeholder="Username"/></td></tr>
        <tr><td><label for="fname">First Name</label></td><td><input id="fname" type="text" name="fname" placeholder="First Name"/></td></tr>
        <tr><td><label for="lname">Last Name</label></td><td><input id="lname" type="text" name="lname" placeholder="Last Name"/></td></tr>
        <tr><td><label for="email">Email</label></td><td><input id="email" type="text" name="email" placeholder="email@example.com"/></td></tr>
        <tr><td><label for="pword">Password</label></td><td><input id="pword" type="password" name="pword" placeholder="password"/></td></tr>
        <tr><td><label for="rpword">Re-type Password</label></td><td><input id="rpword" type="password" name="rpword" placeholder="re-type password"/></td></tr>
    </table>
    <button type="submit" id="regBtn" name="register">Register</button>  

    </form>
</div>


