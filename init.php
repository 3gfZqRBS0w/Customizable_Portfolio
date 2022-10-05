<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__."/config.php");
require_once(__DIR__."/librairies/Parsedown.php");
require_once(__DIR__."/librairies/Utility.php");
require_once(__DIR__."/librairies/Projects.php");
require_once(__DIR__."/librairies/Articles.php");
require_once(__DIR__."/librairies/Logs.php");
require_once(__DIR__."/librairies/Owner.php");
require_once(__DIR__."/vendor/autoload.php"); 

try {
    $bdd = new PDO("mysql:host=".$config["db"]["host"].";dbname=".$config["db"]["bddName"].";charset=utf8", $config["db"]["username"], $config["db"]["password"]) ;
}
catch (PDOException $e) {

    switch ($e->getCode()) {
        case 1045:
            die($config["translations"]["selected"]["pdoErrors"][1045]) ;
        break;
        case 1049:
            die($config["translations"]["selected"]["pdoErrors"][1049]) ; 
        break;
        default:
        die($e->getMessage()); 
    }
}




if (!Utility::bddExists($bdd)) {

    $password = Utility::generatePassword(rand(16,255));
    $hash = hash('sha256', $password);



// creation of the tables of the database
    $query = file_get_contents(__DIR__."/customportfolio.sql");
    $stmt = $bdd->prepare($query);
    $stmt->execute() ;

    foreach( $config["translations"]["en"]["logs"] as $key => $value) {
        $stmt = $bdd->prepare("INSERT INTO tbl_actions(titre_action) VALUES('".$value."')") ;
        $stmt->execute();
    }




    $stmt = $bdd->prepare("INSERT INTO tbl_owner(lastName, surName, nameOfWebsite, websiteSubtitble, secretCode, secretQrCode) VALUES('LASTNAME', 'FIRSTNAME', 'PORTFOLIO OF LASTNAME FIRSTNAME','SUBTITLE','".$hash."', '".$otp->create()->getSecret()."')") ;
    $stmt->execute();
    $stmt->closeCursor() ;


    Utility::addlog($bdd,1) ;
    

   mail(
    $config["recuperation"]["email"],
   $config["translations"]["selected"]["mail"]["setup"]["subject"], 
   $config["translations"]["selected"]["mail"]["setup"]["message"].$password);



    die(Utility::getInstallMessages($password)) ;
}
else {
    if (!Utility::tableIsEmpty($bdd, "tbl_projects")) {
        $config["redirection"]["default"][$config["translations"]["selected"]["navBar"]["myprojects"]] = "#bloc3" ; 
    }

    if (!Utility::tableIsEmpty($bdd, "tbl_articles")) {
        $config["redirection"]["default"][$config["translations"]["selected"]["navBar"]["article"]] = "#bloc5" ; 
    }

    if (!Utility::tableIsEmpty($bdd, "tbl_careers")) {
        $config["redirection"]["default"][$config["translations"]["selected"]["navBar"]["skills"]] = "#bloc4";
    }
}

// initialize object

$Parsedown = new Parsedown();
$Projects = new Projects($bdd);
$Articles = new Articles($bdd);
$Owner = new Owner($bdd);
$Logs = new Logs($bdd);

use OTPHP\TOTP ;

$otp = TOTP::create($Owner->GetQRSecret());

// for Languages

if ( isset($_REQUEST["lang"]) ) {
    if (is_array($config["translations"][$_REQUEST["lang"]])) {
        $lang = $_REQUEST["lang"] ;
        $config["translations"]["selected"] = $config["translations"][$lang] ;
        setcookie("lang", $lang, time() + (86400 * 30), "/");
    }
}
else {
    if (isset($_COOKIE["lang"])) {
        if (is_array($config["translations"][$_COOKIE["lang"]])) {
            $lang = $_COOKIE["lang"] ; 
            $config["translations"]["selected"] = $config["translations"][$lang] ;
        }
    }
}

// for check if is visitor


/*
if ( !isset($_COOKIE["visitor"])) {
    Utility::addlog($bdd, 4) ;
    setcookie("lang", $lang, time() + (86400 * 1), "/");
}
*/

// ALL REDIRECTION

$config["redirection"]["default"] = [
    $config["translations"]["selected"]["navBar"]["presentation"] => "#bloc1",
    $config["translations"]["selected"]["navBar"]["contact"] => "#bloc6"
];

$config["redirection"]["admin"] = [
    $config["translations"]["selected"]["navBar"]["presentation"] => "#bloc1",
    $config["translations"]["selected"]["navBar"]["myprojects"] => "#bloc3",
    $config["translations"]["selected"]["navBar"]["skills"]  => "#bloc4",
    $config["translations"]["selected"]["navBar"]["article"]  => "#bloc5",
    $config["translations"]["selected"]["navBar"]["contact"] => "#bloc6",
    $config["translations"]["selected"]["navBar"]["panel"] => "mastermind"
];

$config["redirection"]["return"] = [
    $config["translations"]["selected"]["navBar"]["return"] => "index.php"
];

$config["redirection"]["return2"] = [
    $config["translations"]["selected"]["navBar"]["return"] => "../index.php"
];

$config["redirection"]["dashboard"] = [
    $config["translations"]["selected"]["navBar"]["dashboard"]  => "dashboard.php",
    $config["translations"]["selected"]["navBar"]["profile"]  => "profile.php",
    $config["translations"]["selected"]["navBar"]["projects"] => "projets.php",
    $config["translations"]["selected"]["navBar"]["career"] => "career.php",
    $config["translations"]["selected"]["navBar"]["articles"] => "articles.php",
    $config["translations"]["selected"]["navBar"]["skills"] => "skill.php",
    $config["translations"]["selected"]["navBar"]["setting"] => "setting.php",
    $config["translations"]["selected"]["navBar"]["portfolio"] => "../../index.php",
    $config["translations"]["selected"]["navBar"]["disconnect"] => "../deconnexion.php"
];



?>

<div class="loader">
        <span class="lettre">C</span>
        <span class="lettre">U</span>
        <span class="lettre">S</span>
        <span class="lettre">T</span>   
        <span class="lettre">O</span>
        <span class="lettre">M</span>
        <span class="lettre">P</span>
        <span class="lettre">O</span>
        <span class="lettre">R</span>
        <span class="lettre">T</span>
        <span class="lettre">F</span>
        <span class="lettre">O</span>
        <span class="lettre">L</span>
        <span class="lettre">I</span>
        <span class="lettre">O</span>
    </div>

   
