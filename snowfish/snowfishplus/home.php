<?php
//start the user session
session_start();

error_reporting(E_ALL ^ E_WARNING); 

//set default variables
$acolor = "black";
$bcolor = "white";
include 'functions.php';
$searchError = "";

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
                <?php setColors($currentUser, $acolor, $bcolor); ?>
                <!--<style>
                        /* Create three unequal columns that floats next to each other */
                        .column {
                          float: left;
                          padding: 0.5%;
                          margin: 0px;
                          border: 1px solid black
                          
                        }
                        
                        /* Left and right column */
                        .column.side {
                          width: 24%;
                        }
                        
                        /* Middle column */
                        .column.middle {
                          width: 48%;
                        }
                        
                        /* Clear floats after the columns */
                        .row:after {
                          content: "";
                          display: table;
                          clear: both;
                        }
                        
                        /*.navbar input {
                                width:96%;
                                margin:2%
                        }*/
                        
                </style>-->
	</head>
	<body>
        
        <div class="row">
                <div class='column side'>
                        <h1>&nbsp;</h1>
                </div>
                
                <div class='column middle'>
                <?php
                        echo "Hello, ". $currentUser . "!";
                ?>
                
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