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

require_once("../../config/basededonnee.php") ;
require_once("../../config/redirection.php") ;
require_once("../../config/recuperation.php") ;
require_once("../../librairies/Utility.php") ;
require_once("../../librairies/Parsedown.php") ; 
require_once("../../init.php");

if (!(isset($_SESSION["codeSecret"]) && Utility::IsValidPassword($bdd, $_SESSION["codeSecret"]))) {
    header('Location: ../index.php');
    //die("<h1><b>Vous n'êtes pas connecté !</b></h1>") ;
    
}



?>


  <link rel="stylesheet" type="text/css" href="../../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../../styles/admin.css">
  <link rel="stylesheet" type="text/css" href="../../styles/panel.css">
    <title>Setting</title>

</head>
<body>
    <?=(Utility::getHeader($CheminPageAdminConnecte, "Settings", "Manage Your Settings")) ?>

    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Panel Settings</h3>
        <?php
        if ( isset($_POST["lastName"]) && isset($_POST["surName"]) && isset($_POST["nameOfWebsite"]) && isset($_POST["websiteSubtitle"]) )
        {
            Utility::addlog($bdd,5) ;
            $lastName = $_POST["lastName"];
            $surName = $_POST["surName"];
            $nameOfWebsite = $_POST["nameOfWebsite"];
            $websiteSubtitle = $_POST["websiteSubtitle"];
        
            echo("<p class='notification' style='background-color: green;' >Setting updating.</p>") ;
            Utility::setOwnerData($bdd, $lastName ,$surName, $nameOfWebsite, $websiteSubtitle) ; 
            
        }
        ?>


<div>
    <div class="contact-form setting">
        <form action="" method="post">
            <p>
                <label>Last Name</label>
                <input value="<?=Utility::getOwnerData($bdd, "lastName")?>" type="text" name="lastName" required> 
            </p>
            <p>
                <label>Surname</label>
                <input value="<?=Utility::getOwnerData($bdd, "surName")?>" type="text" name="surName" required>
            </p>

            <p>
                <label>Name of Website</label>
                <input value="<?=Utility::getOwnerData($bdd, "nameOfWebsite")?>" type="text" name="nameOfWebsite" required>
            </p>
            <p>
               <label>Website Subtitle</label> 
               <input value="<?=Utility::getOwnerData($bdd, "websiteSubtitble")?>" type="text" name="websiteSubtitle" required>
            </p>

            <p>
                <button type="submit">Save</button>
            </p>
        </form>
    </div>
   
    </div>


</body>

<script src="../../script/app.js"></script>
</html>
