<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php

require_once("../../config/basededonnee.php") ;
require_once("../../config/redirection.php") ;
require_once("../../config/recuperation.php") ;
require_once("../../librairies/Utility.php") ;
require_once("../../librairies/Parsedown.php") ; 
require_once("../../init.php");

?>
  <link rel="stylesheet" type="text/css" href="../../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../../styles/admin.css">
    <title>Dashboard</title>

    <style>

.websiteOverview {
    margin-top: 5vh;
    background-color: #e2e2e2;    
    margin-left: 2.5vw;
    margin-right: 2.5vw;
    border-radius: 30px;
    width: 95vw;
    height: 30vh;
}

.titleOfWebsiteOverview {
    background-color: #E8F1F2;
    border-bottom: solid 1px black;
    align-items: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    padding: 10px;
    text-align: center;
}



.elementOfWebsiteOverview {
    display: flex;
    width: 15vw;
    height: 20vh;
    border: 1px solid black;
    min-width: 100px ;
    min-height: 100px ;
    justify-content: space-around;
}

.elements {
    height:80%;
    align-items: center;
    
    display: flex;
    flex-wrap: wrap; 
    justify-content: space-evenly;
}


    </style>
</head>
<body>
    <?php
    echo(Utility::getHeader($CheminPageAdminConnecte, "Dashboard", "Manage your site")) ;
    ?>

    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Website Overview</h3>
        <div class="elements">
        <div class="elementOfWebsiteOverview">
            <div>99</div>
            <div>Visiteur</div>
        </div>
        <div class="elementOfWebsiteOverview">

        </div>
        <div class="elementOfWebsiteOverview">

        </div>
        <div class="elementOfWebsiteOverview">

        </div>
        </div>
    </div>
</body>

<script src="../../script/app.js"></script>
</html>
