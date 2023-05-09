<?php
//start the session
session_start();

if(!isset($_GET["target"]) && !isset($_SESSION['user'])) {
        $target_user = "error";
} elseif (!isset($_GET["target"])) {
        $target_user = $_SESSION['user'];
        
} else {
        $target_user = $_GET["target"];
}




//import all necesary things and set variables
include 'functions.php';
@include "users/" . $target_user . "/info.php";
@include 'users/' . $target_user . '/settings.php';

if($target_user == $_SESSION['user']) {
        if(empty($name) or empty($bio)) {
                $profileError = "Your profile isn't fully finished. Head on to the Settings page to finalize your profile!<br>";
        } else {
                $profileError = "";
        }
}

$posts = load_posts($target_user);

//DELETING POSTS
if(isset($_POST['delete-post'])) {
        $posts = load_posts($targer_user);
        unset($posts[$i]);
        array_values($posts);
        echo explode(", ", $posts);
        save_posts($target_user, $posts);
        
}
$posts = load_posts($target_user);


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="style.css">
                
                <?php setColors($target_user, $acolor, $bcolor); ?>
                <style>
                        html {
                                min-height:100%;
                        }
                        
                        .user-header {
                                background-image: url(<?php echo '"' . $header_link . '"'; ?>);
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: center;
                        }
                        
                        .user-header h1 {
                                padding-top:80px;
                                padding-bottom:180px;
                                font-size:50px;
                                color:white;
                        }
                        
                        .head-pfp {
                                margin-top:-120px;
                                padding-bottom:30px;
                        }
                        
                        .head-pfp img {
                                height:180px;
                                width:180px;
                        }
                        
                        .navbar {
                                position: sticky;
                                top:0px;
                                padding-right:30px;
                                /*background-color: rgba(0,0,0,0.2);*/
                        }
                        
                        .content-container {
                                margin: 20px 10%;
                                padding:20px 20px;
                                /*box-shadow:0px 0px 10px black;*/
                        }
                        
                        .post-title {
                                padding-bottom: 10px;
                                border-bottom: 2px solid black;
                        }
                        
                        .new-post {
                                border-radius:15px;
                                background-color:rgba(255,255,255,0.2);
                                margin: 20px 80px 20px 80px;
                                box-shadow: 10px 10px rgba(89, 89, 89, 0.2);
                        }
                        
                        .new-post img {
                                border-top-left-radius:15px;
                                border-top-right-radius:15px;
                        }
                        
                        .post-desc {
                                /*width:70%;
                                float:left;*/
                                font-family:"Trebuchet MS";
                                padding:10px;
                                
                        }
                        
                        .post-date {
                                /*width:30%;
                                float:left;*/
                                font-family:"Trebuchet MS";
                                font-weight:"lighter";
                        
                        }
                        
                        .navbar-button-2 {
                                padding-left:20px;
                                padding-top:7px;
                                padding-bottom:7px;
                                margin-bottom:20px;
                                border:none;
                                display:block;
                                text-align:left;
                                border-radius:15px;
                                background-color:white;
                                font-size:20px;
                                box-shadow: 10px 10px rgba(0, 0, 0, 0.2);
                        }
                        
                
                </style>
                <title><?php echo $target_user . "'s Profile"; ?></title>
	</head>
	<body>
        
                <div class="middle">
                
                        <div class="user-header middle">
                                <span class="header-text accent"><?php echo "<h1>" . $name . "</h1>"; ?></span>
                        </div>
        
                        <div class="head-pfp">
                                <!--<span><img class="pfp" src="<?php
                                        if(is_readable('users/' . $target_user . '/pfp.png')) {
                                                echo 'users/' . $target_user . '/pfp.png';
                                        } else {
                                                echo 'users/error/pfp.png';
                                        }
                                        ?>"></span>-->
                                        
                                <span><img class="pfp" src="<?php
                                        echo $pfp_link;
                                        ?>">
                                </span>
                                
                        </div>
                </div>
                <div class="row">
                        <div class='column side'>
                                <h1>&nbsp;</h1>
                        </div>
                        <div class='column middle'>
                        
                                <div>
                                        <span class="error"><?php echo $profileError; ?></span>
                                        <h2><span class="accent"><?php echo $bio . "<br>"; ?></span></h2>
                                        <span><?php
                                        for ($i = 0; $i <= count($links); $i++) {
                                        
                                                echo '<a href="' . $links[$i] . '">' . $links[$i] . '</a><br>';
                                        }
                                        
                                        
                                        ?></span>
                                        
                                </div>
                                
                                <div>
                                
                                        <?php
                                        
                                        
                                        //NEW AND IMPROVED POSTS CSS
                                        for ($i = count($posts) - 1; $i >= 0; $i--) {
                                        
                                                /* 0 = post description
                                                 * 1 = post date
                                                 * 2 = image
                                                 *
                                                 */
                                                echo "
                                                        <div class='new-post' id='" . $i . "'>
                                                                
                                                ";                
                                                if (!empty($posts[$i][2])){
                                                        echo "
                                                                <img src='" . $posts[$i][2] . "' width='100%'>";
                                                }
                                                                
                                                echo "                
                                                                <div class='post-content accent'>
                                                                        <h1 class='post-desc'>" . $posts[$i][0] . "</h1>
                                                                        <h2 class='post-date accent'>" . $posts[$i][1] . "</h2>
                                                                        <h1 class=''>Post #" . $i . "</h1>
                                                                        <form method='post' action='profile.php'><input class='' type='submit' name='delete-post' value='" . $i . "'></form>
                        
                                                                </div>
                                                        </div>
                                                ";
                                                
                                        }
                                        
                                        ?>
                                </div>
                        </div>
                        <div class="navbar column side">
                                <?php
                                
                                //include 'navbar.php';
                                
                                ?>
                                <form method="get" action="profile.php">
                                        <input type="search" name="target" width="80%" placeholder="Search..." class="navbar-button-2">
                                        <input type="submit" name="searchSubmit" value="Search" width="20%" class="navbar-button-2 accent">
                                        <span class="error"><?php echo $searchError; ?></span>
                                </form>
                                
                                <a class="navbar-button-2 accent" href="profile.php">Profile</a>
                                <a class="navbar-button-2 accent" href="home.php">Home</a>
                                <a class="navbar-button-2 accent" href="upload.php">Upload</a>
                                <a class="navbar-button-2 accent" href="settings.php">Settings</a>
                                <form method="post" action="profile.php"><input class="navbar-button-2 accent" type="submit" name="logout" value="Log Out"></form>
                        
                                
                                
                        </div>
                </div>
                
        
        <?php
                /*echo "Debug<br>";
                
                echo "target user: " . $target_user . "<br>";
                echo "target name: " . $name . "<br>";
                echo "target bio : " . $bio . "<br>";
                echo "logged in  : " . $_SESSION['user'] . "<br>";
                echo "<form method='post' action='profile.php'><input type='submit' name='logout' value='Log Out'></form>";
                //echo 'body {<br>background-color:' . $bcolor . ';<br>}<br>.accent {<br>color:' . $acolor . ';<br>}';*/
                
                if(isset($_POST['logout'])) {
                        session_unset();
                        session_destroy();
                        echo '<script type="text/javascript">location.href = "login.php";</script>';
                }
                
                
        ?>
        
        
        </body>
</html>