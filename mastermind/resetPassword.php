<?php
session_start();


require_once("../librairies/Utility.php");
require_once("../librairies/Parsedown.php");
require_once("../config.php") ;
require_once("../init.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/main.css">
<link rel="stylesheet" type="text/css" href="../styles/admin.css">
    <title>Document</title>
</head>
<body>
    <?=Utility::getHeader($config["redirection"]["return"], "RESET PASSWORD", "LOGIN PAGE")?>
    <?php
    
    if ( isset($_POST['attempt_email'])) {
        if (isset($_POST['g-recaptcha-response'])) {

            $secretKey = $config["captcha"]["SECRET_KEY"];
      
            $captcha = $_POST['g-recaptcha-response'];
      
            $ip = $_SERVER['REMOTE_ADDR'];
      
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
      
            $responseKeys = json_decode(@file_get_contents($url, false), true);
      
        $attemptEmail = $_POST['attempt_email'];
        if ($responseKeys["success"]) {
        if ($attemptEmail == $mailRecuperation) {
            $newPassword = Utility::generatePassword(128);
            /*
            if (!mail($mailRecuperation, "Your new customizable panel code", "Your new code is $newPassword")) {
                echo ("<p class='notification' style='position: absolute;background-color: green;'>Error</p>"); 
            }
            */ 
        }
    }
        else {
            echo ("<p class='notification' style='position: absolute;background-color: green;'>Captcha incorrect</p>");
        }

    }
        
        echo ("<p class='notification' style='position: absolute;background-color: green;'>if email is good, you will receive an email shortly</p>");

    }
    ?>
    <?=Utility::getResetPasswordPage($config["captcha"]["CLIENT_KEY"], $config["translation"]["selected"])?>
    
</body>
</html>


<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<script src="../script/app.js"></script>