<?php
  require_once("init.php") ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | <?=Utility::getOwnerData($bdd, "lastName")?> <?=Utility::getOwnerData($bdd, "surName")?></title>
    <link rel="stylesheet" type="text/css" href="styles/main.css">
</head>
<body>
    <?php
    if (isset($_POST["titleOfArticle"])) {
        $title = $_POST["titleOfArticle"] ;

        $articleData = $Articles->GetPost($title) ;

        echo(Utility::getHeader($config["redirection"]["return"], $articleData[0]["title"], "" )) ;


        echo(" <div class='bloc' id='bloc1'>
        <div id='container1'>
            <div id='blocTexte1'>
                ".$Parsedown->text($articleData[0]["fullTextOfArticles"])."
            </div>
        </div>") ; 
    }
    ?>
</body>
</html>
<script src="script/app.js"></script>