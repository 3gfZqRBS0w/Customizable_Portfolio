<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once(__DIR__."/config.php");
require_once(__DIR__."/librairies/Parsedown.php");
require_once(__DIR__."/librairies/Utility.php");
require_once(__DIR__."/librairies/Projects.php");
require_once(__DIR__."/librairies/Articles.php");
require_once(__DIR__."/librairies/CarrierType.php");
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


$a = new CarrierType($bdd) ;



print_r($a->GetCarrierTypeIDByTitle("hello"));