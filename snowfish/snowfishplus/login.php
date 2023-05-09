<?php
//start the session
session_start();

include 'functions.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
                <style>
                        body {
                                  /*background-image: linear-gradient(red, yellow);*/
                                  background-repeat: no-repeat;
                        }
                        
                        html {
                                height:100%;
                        }
                        
                        h1 {
                                color:white;
                                text-shadow: 0px 0px 10px black;
                        }
                        
                        a {
                                color:gray;
                        }
                        
                        /*body .accent {
                                color: white;
                        }*/
                        
                        /*.content-container {
                                background-color: #b30000;
                                width: 500px;
                                padding:0% 35% 0% 35%;
                                text-align: left;
                        }
                        
                        input {
                                border-radius:10px;
                                padding:10px;
                                border: 1px solid black;
                                width:100%;
                        }
                        
                        input[type=submit] {
                                width:20%;
                        }*/
                        
                        .content-container {
                                margin: 20px 20%;
                        }
                        
                </style>
                
                <?php
                
                $timestamp = time(); 
                //echo($timestamp);  
                $hour = (date("H", $timestamp));
                if ($hour == 19) {
                        //sunset
                        $backgroundcolor = "linear-gradient(#4b3060,#fd5e53, #fc9c54, #ffe373)";
                } elseif ($hour == 7) {
                        //sunrise
                        $backgroundcolor = "linear-gradient(orange, yellow)";
                } elseif ($hour >= 20 or $hour <=6) {
                        //nighttime
                        $backgroundcolor = "linear-gradient(#000066, #3366ff)";
                
                } else {
                        //daytime
                        $backgroundcolor = "linear-gradient(#66ccff, #ffffff)";
                }
                
                echo "
                        <style>
                                body {
                                        background-image: " . $backgroundcolor . ";
                                }
                        </style>
                ";
                
                ?>
                <title>Log In</title>
	</head>
	<body>
        
        <?php
        
        $usernameError = "";
        $passwordError = "";
        
        if(isset($_POST["submit"])) {
                //check if username is empty
                
                //check if password is empty
                
                //check if user is correct
                if (check_login($_POST['username'], $_POST['password'])) {
                
                //log in
                        $passwordError = "Logged In.";
                        $_SESSION["user"] = $_POST['username'];
                        $_SESSION["password"] = $_POST['password'];
                        echo '<script type="text/javascript">location.href = "home.php";</script>';
                } else {
                        $passwordError = "Wrong Password/Username.";
                }
                
                
                //check if the username is empty, then check if the password is empty; display errors
                /*if(empty($_POST["username"])) {
                        $usernameError = "Please enter your username.";
                        
                        if(empty($_POST["password"])) {
                                $passwordError = "Please enter your password.";
                        }
                        
                } else {
                        //format username
                        $username = format_input($_POST["username"]);
                        
                        //check if the password field is empty, show error if it is
                        if(empty($_POST["password"])) {
                                $passwordError = "Please enter your password.";
                        } else {
                                //set the password and get the user's password
                                $password = $_POST["password"];
                                
                                
                                if(is_readable("users/" . $username . "/p.txt")) {
                                
                                        $passFile = fopen("users/" . $username . "/p.txt", "r") or die("User doesn't exist");
                                        $storedPass = fread($passFile,filesize("users/" . $username . "/p.txt"));
                                        fclose($passFile);
                                
                                        //check if the password is the same
                                        if ($password == $storedPass) {
                                                //TODO if password is correct, set the session vars and redirect to home page
                                                $passwordError = "correct password";
                                                
                                                $_SESSION["user"] = $username;
                                                $_SESSION["password"] = $password;
                                                
                                                //header("Location: home.php");
                                                echo '<script type="text/javascript">location.href = "home.php";</script>';
                                                
                                        } else {
                                                //if passsword is incorrect, give user the error
                                                $passwordError = "Incorrect password. Please try again.";
                                        }
                                } else {
                                        $usernameError = "Username does not exist. Please try again.";
                                }
                        }
                }*/
        }

        
        ?>
        
        <?php
        
        $usernameError2 = "";
        $passwordError2 = "";
        
        
        if(isset($_POST["signup"])) {
                $newusername = $_POST['newusername'];
                $newname = $_POST['newname'];
                $newpass = $_POST['newpass'];
                $newpass2 = $_POST['newpass2'];
        
        
                //check if the username is empty, then check if the password is empty; display errors
                if(empty($newusername)) {
                        $usernameError2 = "*Please enter a username.";
                        
                } else {
                
                        //check to see if username is taken
                        if (is_readable("users/" . $newusername . "/p.txt")) {
                                $usernameError2 = "This username is already taken. Please choose another.";
                        } else {
                                $usernameError2 = "Username is free"; //DEBUG
                                //check if the passwords are empty
                                if (empty($newpass)) {
                                        $passwordError2 = "Please enter a password.";
                                } else {
                                        //check if passwords match
                                        if (!($newpass == $newpass2)) {
                                                $passwordError2 = "Passwords do not match.";
                                        } else {
                                                
                                                mkdir('users/' . $newusername);
                                                
                                                //mkdir('users/' . $newusername . '/posts.json');
                                                
                                                save_posts($newusername, array());
                                                save_info($newusername, $newname, "", "");
                                                save_settings($newusername, "#000000", "#ffffff", "users/error/header.png", "users/error/pfp.png");
                                                
                                                //create password file
                                                /*$newPassFile = fopen("users/" . $newusername . "/p.txt", "w");
                                                fwrite($newPassFile, $newpass);
                                                fclose($newPassFile);*/
                                                
                                                //make password file
                                                file_put_contents('users/' . $newusername . '/p.txt', $newpass);
                                                
                                                $_SESSION["user"] = $newusername;
                                                $_SESSION["password"] = $newpass;
                                                
                                                echo '<script type="text/javascript">location.href = "profile.php";</script>';
                                        }
                                }
                        }
                }
        }
        
        ?>
        
		<div class="middle">
                        <div class="middle">
                                <h1>Welcome to Snowfish Plus</h1><br>
                        
                                <h1>Login or <a href='#new'>Make an Account</a></h1>
                                
                        </div>
                        <div class="middle content-container accent">
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                
                                        <label><b>Username:</b></label><br>
                                        <input type="text" name="username" pattern="[0-9a-z]+" value=<?php if(isset($_POST['username'])) { echo $_POST['username']; } else { echo ""; } ?>><br>
                                        <span class="error"><?php echo $usernameError;?></span><br><br>
                                        
                                        <label><b>Password:</b></label><br>
                                        <input type="password" name="password"><br>
                                        <span class="error"><?php echo $passwordError;?></span><br><br>
                                        
                                        <input type="submit" name="submit" value="Log In">
                                </form>
                        </div>
                </div>
                
                <div class="middle">
                
                        <br>
                
                        <h1 id="new">Make an account</h1>
                        
                </div>
                <div class="column side">
                <h1>&nbsp;</h1>
                </div>
                <div class="login-form middle content-container accent">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        
                                <label><b>Username:</b> (can only contain lowercase letters and numbers.)</label><br>
                                <input type="text" name="newusername" pattern="[0-9a-z]+"><br>
                                <span class="error"><?php echo $usernameError2;?></span><br><br>
                                
                                <label><b>Name:</b></label><br>
                                <input type="text" name="newname"><br><br>
                                
                                <label><b>Password:</b> Please don't reuse your password. We didn't put a lot of security into this app.</label><br>
                                <input type="password" name="newpass"><br><br>
                                <label><b>Verify Your Password:</b></label><br>
                                <input type="password" name="newpass2"><br>
                                <span class="error"><?php echo $passwordError2;?></span><br><br>
                                
                                <input type="submit" name="signup" value="Sign Up">
                        </form>
                </div>
	</body>
        
</html>