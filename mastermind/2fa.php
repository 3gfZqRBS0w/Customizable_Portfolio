<?php
session_start();

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
    <?php
    echo (Utility::getHeader($config["redirection"]["return2"],"2FA",  "2FA")) ;
    if (isset($_POST["qrCode"])) {
        $attempt= $_POST["qrCode"] ; 
        if (strlen($_POST["qrCode"]) == 6) {
            if ($otp->verify($attempt)) {
                echo("<p class='notification' style='background-color: green;' >Bon code</p>") ;
                header("Refresh: 5;url=index.php");
            }
            else {
                echo("<p class='notification' style='background-color: red;' >Mauvais code</p>") ;
            }
        }
    }
    echo( Utility::getQRCodePage($config["captcha"]["CLIENT_KEY"], $config["translations"]["selected"])) ;
    ?>
</body>
</html>

<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<script src="../script/app.js"></script>