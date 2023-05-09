<?php

//set the target user's colors as background colors
function setColors($target, $acolor, $bcolor) {
        echo '<style>
                body {
                        background-color:' . $bcolor . ';
                        background-image:' . $bcolor . ';
                        background-repeat: no-repeat;
                }
                .accent {
                        color:' . $acolor . ';
                }
        </style>';
}

//format the data, (get rid of spaces at end and beginning, get rid of slashes, html special chars)
function format_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}

function check_login($username, $password) {
        if(is_readable("users/" . $username . "/p.txt")) {
                                
                $passFile = fopen("users/" . $username . "/p.txt", "r") or die("User doesn't exist");
                $storedPass = fread($passFile,filesize("users/" . $username . "/p.txt"));
                fclose($passFile);
        
                //check if the password is the same
                if ($password == $storedPass) {
                        return true;
                        
                } else {
                        return false;
                }
        } else {
                return false;
        }
}

function save_info($target, $name, $bio, $links) { 
        file_put_contents('users/' . $target . '/info.php', '<?php $name = "' . $name . '"; $bio = "' . $bio . '"; $links = array(' . $links . '); ?>');
}

function save_settings($target, $acolor, $bcolor, $header_link, $pfp_link) { 
        file_put_contents('users/' . $target . '/settings.php', '<?php $acolor = "' . $acolor . '"; $bcolor = "' . $bcolor . '"; $header_link = "' . $header_link . '"; $pfp_link = "' . $pfp_link . '"; ?>');
}

function load_posts($target) {
        if(is_readable("users/" . $target . "/posts.json")) {
                $postsFile = fopen("users/" . $target . "/posts.json", "r") or die("User doesn't exist");
                $postsJSON = fread($postsFile,filesize("users/" . $target . "/posts.json"));
                fclose($postsFile);
                $posts = json_decode($postsJSON);
                return $posts;
        } else {
                return array();
        }       
}

function save_posts($target, $posts) {
        $postsJSON = json_encode($posts);
        file_put_contents("users/" . $target . "/posts.json", $postsJSON);
}
?>