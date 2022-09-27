<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    session_start();

    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    require_once("../../init.php");

    if (!(isset($_SESSION["codeSecret"]) && Utility::IsValidPassword($bdd, $_SESSION["codeSecret"]))) {
        header('Location: ../index.php');
        //die("<h1><b>Vous n'êtes pas connecté !</b></h1>") ;

    }
    ?>
    <link rel="stylesheet" type="text/css" href="../../styles/main.css">
    <link rel="stylesheet" type="text/css" href="../../styles/admin.css">
    <link rel="stylesheet" type="text/css" href="../../styles/panel.css">
<body>
<?= (Utility::getHeader($config["redirection"]["dashboard"], "Article", "Publish your article")) ?>

<div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Add Article</h3>


<div class="contact-form setting">
<?php

if ( isset( $_POST["articleTitle"])) {
    
}


?>

            <form action="" method="post" enctype="multipart/form-data">
                <p>
                    <label for="articleTitle">Article title</label>
                    <input id="articleTitle" placeholder="Nom de l'article" value="" type="text" name="articleTitle" required>
                </p>

                <p>
                    <button value="submit" type="submit">Save</button>
                </p>
            </form>
        </div>
    </div>
    
</body>

<script src="../../script/app.js"></script>
</html>