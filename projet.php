<?php
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


    if ( isset($_POST["titleOfProjet"]) ) {
        $title = $_POST["titleOfProjet"];

        $projetData = Utility::getData($bdd, $title, "tbl_projects") ;
        
        echo(Utility::getHeader($config["redirection"]["return"], $projetData[0]["title"], "")) ;


        echo(" <div class='bloc' id='bloc1'>
        <div id='container1'>
            <div id='blocTexte1'>
                ".$Parsedown->text($projetData[0]["fullTextOfProject"])."
            </div>
        </div>") ; 
    }
    ?>

</div>
</body>
</html>
<script src="script/app.js"></script>
