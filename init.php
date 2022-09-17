<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//[0pnBbaXMvpcN4[D!17sZwcD3HnaCcjdFEmqwWA?2y)w(*2WupzDyyRQ]FT680LmVp2plFE5(nD1PI6ENEjgmy0cZ8!ejSyHL*FzJs]U2eH)*t[BKofjMSxDzEn.WpEt
// Connexion à la bdd 
try {
    $bdd = new PDO("mysql:host=$host;dbname=$nomBDD;charset=utf8", $nomUtilisateur, $motDePasse) ;
}
catch (PDOException $e) {
    die("Echec de la connexion : ".$e->getMessage());
}

if (!Utility::bddExists($bdd)) {



    $password = Utility::generatePassword(128);
    $hash = hash('sha256', $password); 
    echo("le hash renvoie ".$hash) ;
    $query = file_get_contents("sql/database.sql");
    $stmt = $bdd->prepare($query);
    $stmt->execute() ;

    $query = "UPDATE tbl_owner SET secretCode = '$hash' ;" ;
    $stmt = $bdd->prepare($query) ;
    $stmt->execute();
    $stmt->closeCursor() ;

    Utility::addlog($bdd,1) ;
    

    mail($mailRecuperation,"L'installation du portfolio est une réussite","Le mot de passe est $password"); 
    die(Utility::getInstallMessages($password)) ;
}

$Parsedown = new Parsedown();
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

   
