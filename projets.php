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
      echo(Utility::getHeader($config["redirection"]["return"], "My Projects", "All my projects")) ;
      echo("<div id='listeDesProjets'>") ; 
      $allProjects = $Projects->GetAllPosts(); 
      
      $i = 0 ; 

      if ( count($allProjects) > 0) {
         foreach ($allProjects as $value) {
            if ($i == 0) {
               echo("<div style='padding-top: 2vh;' class='container1'>") ;
               Utility::displayPreviewProject($value["title"],"upload/".$value["photoName"]) ;
            }
            else if ($i >= 3) {
               echo("</div><div style='padding-bottom: 2vh;' class='container1'>") ;
               Utility::displayPreviewProject($value["title"],"upload/".$value["photoName"]) ;
               $i = 1 ; 
            }
            else {
               Utility::displayPreviewProject($value["title"],"upload/".$value["photoName"]) ;
            }
            $i++ ;
         }
         echo("</div>") ; 
      }
      else {
         echo("<p>Il n'y a aucun projet mis en ligne</p>") ; 
      }

    ?>




</body>
</html>


<script src="script/app.js"></script>