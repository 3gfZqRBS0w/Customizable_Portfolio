<?php
//sR3ujo-bKlgFDfzI)Cnezrzwov4jb(tvkQ!fZ5!(Gp9bO)OwZ21TRVEsOMCK4*Rlxhvc38.tsL8ki!UIVHq9Wof]plihzHc0R!1)mtyQm(vATlc920ZKh30aqdO[GUqD

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

    $password = Utility::generatePassword(128);
    $hash = hash('sha256', $password); 


// creation of the tables of the database
    $query = file_get_contents("customportfolio.sql");
    $stmt = $bdd->prepare($query);
    $stmt->execute() ;



    $query = "UPDATE tbl_owner SET secretCode = '$hash' ;" ;
    $stmt = $bdd->prepare($query) ;
    $stmt->execute();
    $stmt->closeCursor() ;

    Utility::addlog($bdd,1) ;
    

   mail(
    $config["recuperation"]["email"],
   $config["translations"]["selected"]["mail"]["setup"]["subject"], 
   $config["translations"]["selected"]["mail"]["setup"]["message"].$password);



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

   
