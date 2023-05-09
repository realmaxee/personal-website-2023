<?php
//start the user session
session_start();

error_reporting(E_ALL ^ E_WARNING); 

//set default variables
$acolor = "black";
$bcolor = "white";
include 'functions.php';
include 'nonowords.php';
$searchError = "";
$postError = "";
$post_text = "";
$post_img = "";

//check if there is a user logged in
if(!isset($_SESSION["user"])) {
	//goto login.php
	header("Location: login.php");
} else {
        $currentUser = $_SESSION["user"];
        include 'users/' . $currentUser . '/info.php';
        include 'users/' . $currentUser . '/settings.php';
}




//search php

        if(isset($_POST['searchSubmit'])) {
                $searchUser = format_input($_POST['search']);
                
                if(is_readable('users/' . $searchUser . '/p.txt')) {
                        header("Location: profile.php?target=" . $searchUser);
                } else {
                        $searchError = "User not found.";
                }
        }


        
?>

<html>
	<head>
		<link rel="stylesheet" href="style.css">
                <?php
                setColors($currentUser, $acolor, $bcolor);
                ?>
                <title>Upload a post</title>
                <style>
                        .content-container {
                                padding:15px 15%;
                                margin: 20px 0px;
                                text-align: left;
                        }
                </style>
                
	</head>
	<body>
        
        
        
        <div class="row">
                <div class='column side'>
                        <h1>&nbsp;</h1>
                </div>
                
                <div class='column middle'>
                        <?php
                                if(isset($_GET['postsubmit'])) {
                                        $post_text = htmlspecialchars($_GET['post']);
                                        $post_img = $_GET['post_img'];
                                        $isPostable = true;
                                        
                                        /*check for bad words
                                        for ($i = 0; $i < count($no_no_words); $i++) {
                                                if (strpos($post_text, $no_no_words[$i]) != false) {
                                                        $isPostable = false;
                                                }
                                        }
                                        echo $isPostable;
                                        echo strpos($post_text, $no_no_words[2]);*/
                                        if ($isPostable) {
                                                $newpost = array($post_text, date("Y/m/d"), $post_img);
                                                $posts = load_posts($currentUser);
                                                $posts[] = $newpost;
                                                save_posts($currentUser, $posts);
                                                
                                                $postnumber = count($posts);
                                                
                                                echo "
                                                        
                                                        <div class='content-container accent post'>
                                                                <h1 class='post-title'>You posted:</h1>
                                                                <h2 class=''>" . $newpost[0] . "</h1>
                                                                <h5 class='post-title'>Posted on " . $newpost[1] . ".</h5>
                                                                <a class='navbar-button' href='profile.php#" . $postnumber . "'>Click here to see the post</a>
                                                        </div>
                                                ";
                                        
                                        } else {
                                                $postError = "no bad words allowed. please try again.";
                                        }
                                }
                                
                        ?>
                        <div class='content-container'>
                                <form method="get" action="upload.php">
                                        <label><b>Post Text</b></label><br>
                                        <input type="text" name="post" width="80%" placeholder="Type your post..." class="navbar-button" value="<?php echo $post_text; ?>"><br><br>
                                        <label><b>Image link</b> you can post a link to an image you would like to post.</label><br>
                                        <input class="navbar-button" type="text" name="post_img" id="post_img" placeholder="Paste link to image here..." value="<?php echo $post_img; ?>"><br>
                                        <input type="submit" name="postsubmit" value="Post" width="20%" class="navbar-button accent">
                                        <span class="error"><?php echo $postError; ?></span>
                                </form>
                        </div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                
                </div>
                
                <div class="navbar column side accent">
                        <?php
                                include 'navbar.php';
                        ?>
                        
                        
                        
                </div>
        </div>
        
        
        
        
        </body>
</html>