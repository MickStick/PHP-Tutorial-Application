
    <img src="../../public/static/logo.png" alt="Company Logo">
    <h1><a href="home.php">PHP Test</a></h1>
    <form id="hsearchForm" medthod="GET" action="findPeople.php" enctype="multipart/form-data">
		<input type="text" name="hsearch" id="hsearch" />
		<button> <i class="material-icons">search</i></button>
    </form>
   
    <ul id="nav-list">
        <li title="Home" id="home-link"><a href="home.php"><i class="material-icons">public</i></a></li>
        <li title="Messages" id="msg-link"><a href=""><i class="material-icons">message</i></a></li>
        <li title="Notifs" id="notif-link"><a href="" id="notifs"><i class="material-icons">notifications</i></a></li>
        <li title="Settings" id="set-link"><a id="settings"><i class="material-icons">settings</i></a></li>
    </ul>
    <div class="Notification-Wrapper" style="position: absolute; right: 0%; top: 125px; display: none; width: 500px; border: 1px solid;">
    	<?php
    		include "notifications.php";
    	?>
    </div>

    <a href="profile.php" id="name" title="You"><?php echo $_SESSION["fname"]. " " .$_SESSION["lname"]; ?></a>
<ul id="settings-list" hidden>
	<li><a id="edit-profile">Edit Profile</a></li>
	<li><a id="logout" href="controller/logout.php">Logout</a></li>
</ul>

<div class="edit-wrapper" hidden>
	<div class="edit-container">
		<button><i  class="material-icons">close</i></button>
		<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']?>" enctype="multipart/form-data">
			<label> Edit Profile </label>
			<span><img id="edit-pic" alt=" " src="<?php echo $_SESSION["propic"];?>" /></span>
			<label for="file">
				Edit Profile Picture
				<input name="file" type="file" accept="image/png,image/jpg"/>
			</label>
			<table>
				<tr><td><label for="">First Name</label></td></tr>
				<tr><td><input type="text" name="fname" placeholder="<?php echo $_SESSION["fname"];?>"/></td></tr>
				<tr><td><label for="">Last Name</label></td></tr>
				<tr><td><input type="text" name="lname" placeholder="<?php echo $_SESSION["lname"];?>"/></td></tr>
				<tr><td><label for="">Email</label></td></tr>
				<tr><td><input type="text" name="email" placeholder="<?php echo $_SESSION["email"];?>"/></td></tr>
			</table>
			<button type="submit" id="editBtn" name="edit">Edit</button>
		</form>
	</div>
</div>
