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

    $password = Utility::generatePassword(rand(16,255));
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

$Parsedown = new Parsedown();

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

   
