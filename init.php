<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("config/basededonnee.php") ;
require_once("config/redirection.php") ;
require_once("config/recuperation.php") ;   
require_once("librairies/Utility.php") ; 

// Connexion à la bdd 
try {
    $bdd = new PDO("mysql:host=$host;dbname=$nomBDD;charset=utf8", $nomUtilisateur, $motDePasse) ;
}
catch (PDOException $e) {
    die("Echec de la connexion : ".$e->getMessage());
}



if (!Utility::bddExists($bdd)) {

    $password = Utility::generatePassword(128); 
    $query = file_get_contents("sql/database.sql");
    $stmt = $bdd->prepare($query);
    mail($mailRecuperation,"L'installation du portfolio est une réussite","Le mot de passe est $password");
    die(Utility::getInstallMessages($stmt->execute(), $password)) ;
}


?> 