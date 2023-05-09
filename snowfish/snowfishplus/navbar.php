<?php
echo '
<form method="get" action="profile.php">
        <input type="search" name="target" width="80%" placeholder="Search..." class="navbar-button">
        <input type="submit" name="searchSubmit" value="Search" width="20%" class="navbar-button accent">
        <span class="error"><?php echo $searchError; ?></span>
</form>
<ul class="accent">
        <li><a class="navbar-button accent" href="profile.php">Profile</a></li>
        <li><a class="navbar-button accent" href="home.php">Home</a></li>
        <li><a class="navbar-button accent" href="upload.php">Upload</a></li>
        <li><a class="navbar-button accent" href="settings.php">Settings</a></li>
        <li><form method="post" action="profile.php"><input class="navbar-button accent" type="submit" name="logout" value="Log Out"></form></li>
</ul>
';

?>