<?php
    require_once("config.php") ; 
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

$allArticle = $Articles->GetAllPosts();
      echo(Utility::getHeader($config["redirection"]["return"], "My Articles", "All my projects")) ;
      echo("<div id='listeDesProjets'>") ; 
      
      if ( count($allArticle) > 0) {
         echo("<div class='bloc' id='bloc5'>

         
     <div class='veilleTechnologique'>") ; 
     $i = 0 ;
     
     foreach ( $allArticle as $Article ) {
     
             Utility::displayPreviewArticle($Article["title"],$Article["fullTextOfArticles"] ) ; 
   
     }


     echo("</div>
     </div>") ; 
     }
    ?>
</body>
</html>


<script src="script/app.js"></script>