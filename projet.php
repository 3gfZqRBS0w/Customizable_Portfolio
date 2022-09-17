<?php
    require_once("config/basededonnee.php") ;
    require_once("config/redirection.php") ;
    require_once("config/recuperation.php") ;
    require_once("librairies/Parsedown.php") ; 
    require_once("librairies/Utility.php") ;
    require_once("init.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/main.css">
    <title>Portfolio | <?=Utility::getOwnerData($bdd, "lastName")?> <?=Utility::getOwnerData($bdd, "surName")?></title>
</head>
<body>
    <?php


$title = $_GET["titleOfProject"];
$projetData = Utility::getProjectData($bdd, $title) ;

echo(Utility::getHeader($PortfolioRetour, $title, "")) ;




    
    ?>
 <div class="bloc" id="bloc1">
            <div id="container1">
                <div id="blocTexte1">
                    <?= $Parsedown->text($projetData[0]["fullTextOfProject"]) ?>
                </div>
            </div>
</div>
</body>
</html>

<script src="script/app.js"></script>