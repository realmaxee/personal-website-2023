<?php
//start the user session
session_start();

include 'functions.php';

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

//logout php
if(isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        echo '<script type="text/javascript">location.href = "login.php";</script>';
}

?>

<html lang="en">
	<head>
		<link rel="stylesheet" href="style.css">
                <title>Profile Settings</title>
                <style>
                        .pfp {
                                height:180px;
                                width:180px;
                                margin:10px 0px;
                        }
                        
                        .content-container {
                                padding:15px 15%;
                                margin: 20px 0px;
                                text-align: left;
                        }
                        
                        
                </style>
	</head>
	<body>
        
                <?php
                        setColors($currentUser, $acolor, $bcolor);
                
                        if(isset($_POST['infosubmit'])) {
                                
                                save_info($currentUser, $_POST['name'], $_POST['bio'], $_POST['links']);
                                
                                include 'users/' . $currentUser . '/info.php';
                        
                        
                        }
                        
                        if(isset($_POST['miscsubmit'])) {
                                
                                save_settings($currentUser, $_POST['acolor'], $_POST['bcolor'], $header_link, $pfp_link);
                                
                                include 'users/' . $currentUser . '/settings.php';
                                setColors($currentUser, $acolor, $bcolor);
                        
                        
                        }
                        
                        if(isset($_POST['imgsubmit'])) {
                                save_settings($currentUser, $acolor, $bcolor, $_POST['header_link'], $_POST['pfp_link']);
                                
                                include 'users/' . $currentUser . '/settings.php';
                                
                        }
                
                        /*if(isset($_POST['pfpsubmit'])) {
                                $target_dir = "users/" . $currentUser . "/";
                                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                                $newFileName = "pfp.png";
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                                
                                // Check if image file is a actual image or fake image
                                if(isset($_POST["submit"])) {
                                  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                                  if($check !== false) {
                                    echo "File is an image - " . $check["mime"] . ".";
                                    $uploadOk = 1;
                                  } else {
                                    echo "File is not an image.";
                                    $uploadOk = 0;
                                  }
                                }
                                
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                  echo "Sorry, file already exists.";
                                  $uploadOk = 0;
                                }
                                
                                
                                
                                // Allow certain file formats
                                if($imageFileType != "png") {
                                  $pfpError = "Sorry, only PNG files are allowed.";
                                  $uploadOk = 0;
                                }
                                
                                  
                                // if everything is ok, try to upload file
                                else {
                                  try {
                                          move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newFileName);
                                          $pfpError =  "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded to " . $target_dir . $newFileName;
                                  } catch (Exception $ea) {
                                            $pfpError =  "Sorry, there was an error uploading your file.";
                                  }
                                }
                                
                        }*/
                        
                ?>
        
                <div class="row">
                        <div class='column side'>
                                <h1>&nbsp;</h1>
                        </div>
                        
                        <div class='column middle'>
                                <div>
                                        <h1>Settings</h1>
                                </div>
                        
                                <!--<div class="content-container accent">
                                        <h2>PFP and Header</h2>
                                        <form action="settings.php" method="post" enctype="multipart/form-data">
                                                <span><?php echo '<img class="pfp" src="users/' . $currentUser . '/pfp.png"><br>'; ?></span>
                                                <label>Change Profile Picture:</label><br>
                                                <input type="file" name="fileToUpload" id="fileToUpload"><br>
                                                <span class="error"><?php echo $pfpError; ?></span><br>
                                                <input type="submit" value="Upload Image" name="pfpsubmit">
                                        
                                        
                                        </form>
                                        
                                </div>-->
                                
                                <div class="content-container accent">
                                        <h2>PFP and Header</h2>
                                        <form action="settings.php" method="post" enctype="multipart/form-data">
                                                <span><?php echo '<img class="pfp" src="' . $pfp_link . '"><br>'; ?></span>
                                                <span><?php echo '<img class="pfp" src="' . $header_link . '"><br>'; ?></span>
                                                <label>Change Profile Picture:</label><br>
                                                <input class="navbar-button" type="text" name="pfp_link" id="pfp_link" placeholder="Paste link to image here..." value="<?php echo $pfp_link; ?>"><br>
                                                <label>Change Header Picture:</label><br>
                                                <input class="navbar-button" type="text" name="header_link" id="header_link" placeholder="Paste link to image here..." value="<?php echo $header_link; ?>"><br>
                                                <span class="error"><?php echo $pfpError; ?></span><br>
                                                <input class="navbar-button" type="submit" value="Save PFP and Header images" name="imgsubmit">
                                        
                                        
                                        </form>
                                        
                                </div>
                                
                                <div class="content-container accent">
                                        <h2>Public Information</h2>
                                        <form action="settings.php" method="post">
                                                <label><b>Name</b></label><br>
                                                <input class="navbar-button" type="text" name="name" value="<?php echo $name; ?>"><br>
                                                
                                                <label><b>Bio</b></label><br>
                                                <input class="navbar-button" type="text" name="bio" lines="3" value="<?php echo $bio; ?>"><br>
                                                
                                                <label><b>Links</b> (enter links seperated by commas)</label><br>
                                                <input class="navbar-button" type="text" name="links" value=""><br>
                                                
                                                <input class="navbar-button" type="submit" name="infosubmit">
                                        </form>
                                </div>
                                
                                <div>
                                        <h1>Advanced Settings</h1>
                                </div>
                                
                                <div class="content-container accent">
                                        <h2>Misc Settings</h2>
                                        <form action="settings.php" method="post">
                                                <label><b>Accent Color</b> (Only works with Hexadecimal values)</label><br>
                                                <input class="navbar-button" type="text" name="acolor" value="<?php echo $acolor; ?>"><br>
                                                
                                                <label><b>Background Color</b> (Only takes hexadecimal values (eg: #00ffab), and basic color names (eg: blue)</label><br>
                                                <input class="navbar-button" type="text" name="bcolor" lines="3" value="<?php echo $bcolor; ?>"><br>
                                                
                                                
                                                <input class="navbar-button" type="submit" name="miscsubmit">
                                        </form>
                                </div>
                        
                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        
                        </div>
                        
                        <div class="navbar column side link accent">
                                
                                <?php
                                
                                include 'navbar.php';
                                
                                ?>
                                
                                
                                
                        </div>
                </div>
        </body>
</html>