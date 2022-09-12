<?php


class Utility {

// PATH LIST ////////////////////////////////////

  const PROFILE_PATH = "images/portrait.png" ;
  const SUMMARY_PATH = "markdown/summary.md" ;
  const LIBELLE_PORTRAIT_PATH = "markdown/libellePortrait.md" ;
  const CLOSING_MESSAGE_PATH = "markdown/closing_message.md" ;

/////////////////////////////////////////////////



// LOGS METHODS ////////////////////////////////////

  public static function addlog($pdo,$code) {

    $query = "INSERT INTO tbl_logs(horodatage, addr_ip, user_agent, actionid_fk) VALUES(NOW(),'".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."', $code) ;" ;
    $stmt = $pdo->prepare($query) ;
    $stmt->execute();
    $stmt->closeCursor();
    
  }

  public static function getlogs($pdo) {
    $query = "SELECT horodatage, addr_ip, user_agent,titre_action FROM tbl_logs INNER JOIN tbl_actions ON id_action = actionid_fk ORDER BY horodatage DESC ;" ;
    $stmt = $pdo->prepare($query) ;
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;

  }

///////////////////////////////////////////////////




//// INSERT, UPDATE AND DELETE QUERY METHODS //////////////////////////////////


// for update or insert method projects

public static function addNewProject($pdo,$projectName, $picturePath) {
  $query = "INSERT INTO tbl_projects(title, photoPath, textPath) VALUES (".$pdo->quote($projectName).", '.$picturePath.', 'Hello World : D')";
  $stmt = $pdo->prepare($query) ;
  $stmt->execute();

}

public static function editProjects($pdo,$projectTitle,$projectText) {
  $query = "UPDATE tbl_projects SET title = ".$pdo->quote($projectTitle).", textPath = ".$pdo->quote($projectText)." WHERE title = ".$pdo->quote($projectTitle).";" ;
  echo($query); 
  $stmt = $pdo->prepare($query) ;
  $stmt->execute();

}

public static function deleteProjects($pdo,$projectName) {
  $query ="DELETE FROM tbl_projects WHERE title = ".$pdo->quote($projectName)." ; ";
  $stmt = $pdo->prepare($query) ;
  $stmt->execute();

}





//////////////////////////////////////////////////////



  public static function IsValidPassword($pdo,$password) {
    $stmt = $pdo->prepare("SELECT secretCode FROM tbl_owner WHERE 1;");
    $stmt->execute();
    $validHachedPassword = $stmt->fetch(PDO::FETCH_ASSOC);
    $hashedPassword = hash('sha256',$password);


    if ($validHachedPassword["secretCode"] == $hashedPassword) {
      return true;
    }
    else {
      return false;
    }
  }


  public static function ExtractHTMLFromMarkDownFile($pdo, $champ) {

    $Parsedown = new Parsedown();
    
    $stmt = $pdo->prepare("SELECT `$champ` FROM `tbl_owner` WHERE 1;");
    $stmt->execute();
    $path = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($Parsedown->text(file_get_contents($path[$champ]))) ; 

  }


  // INTERROGATION METHODS ////////////////////////////////////


  public static function lastSuccessfulConnection($pdo, $ip) {

    $query ="SELECT horodatage FROM tbl_logs WHERE addr_ip='$ip' AND actionid_fk=3 ;" ;
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result["horodatage"] ;

  }


 


  public static function potentiallyBruteForceAttack($pdo, $ip) {

    $date = $pdo->quote(Utility::lastSuccessfulConnection($pdo, "127.0.0.1")) ;
    $query = "SELECT COUNT(*) FROM tbl_logs
    WHERE actionid_fk=2 AND horodatage BETWEEN $date AND CONCAT(YEAR(CURDATE()),'-',MONTH(CURDATE()) ,'-', DAY(CURDATE()),' 23:59:59') AND addr_ip='$ip';" ;

    
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

if ( $result["COUNT(*)"] > 10 ) {
  return true ; 
}
else {
  return false ; 
}


  }


  public static function getNumberOfItem($pdo, $table) {

    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM $table ;") ;
    $stmt->execute();
    $path = $stmt->fetch(PDO::FETCH_ASSOC);

    return $path["COUNT(*)"] ;
  }


  public static function getOwnerData($pdo, $champ) {
    $stmt = $pdo->prepare("SELECT `$champ` FROM `tbl_owner` WHERE 1;");
    $stmt->execute();
    $path = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $path[$champ] ;
  }


public static function setOwnerData($pdo, $lastName, $firstName, $nameOfWebsite, $websiteSubtitle) {

  $stmt = $pdo->prepare("UPDATE `tbl_owner` SET `lastName`=".$pdo->quote($lastName).",`surName`=".$pdo->quote($firstName).",`nameOfWebsite`=".$pdo->quote($nameOfWebsite).",`websiteSubtitble`=".$pdo->quote($websiteSubtitle)." WHERE 1 ;") ;
  $stmt->execute();

}

// for project's interrogations 

public static function getAllProjectsNames($pdo) {
  $stmt = $pdo->prepare("SELECT title FROM tbl_projects ;");
  $stmt->execute();
  $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $resultat;
}

public static function getProjectData($pdo, $project) {

  $stmt = $pdo->prepare("SELECT title, photoPath, textPath FROM tbl_projects WHERE title=".$pdo->quote($project)." ;");
  $stmt->execute();
  $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

  return $resultat;
}

  ////////////////////////////////////////////////////////

  // RECURRING HTML ////////////////////////////////////
    
    public static function getFooter() {
        return "<div>
        <footer>
           <a href='index.php' aria-current='page'>Remonter en haut de la page</a> 
        </footer>
    </div>" ; 
    }

    public static function getHeader($listOfCategory, $titleOfWebsite, $subtitleOfWebsite) {

      $str = "";
      foreach ($listOfCategory as $key => $value) {
        $str = $str.("<a  href='".$value."' class='nav-link' aria-current='page'>".$key."</a>\n");
      }
        return "<header>
        <div id='head'>
          <h1 id='titre'>".$titleOfWebsite."</h1><br>
          <b><p>".$subtitleOfWebsite."</p></b>
        </div>
      </header>
      
      <nav class='navPortfolio'>".$str."
      
      </nav>" ; 
    }

    static function getInstallMessages($pass) {

    return (" <h1>Le site a correctement été installé sur le serveur</h1>
        <p>Le mot de passe administrateur est ".$pass." .</p>
        <p>Il a été envoyée a l'adresse email configurée</p>
        ") ; 

     
    }

    static function getLoginPage() {
      return ("
    <div class='blocv2'>

      <div class='formConnection'>
  
        <div class='contact-form'>
  
          <form action='' method='POST'>
            <h1>Page de connexion</h1>
  
            <p>
              <label>Code Secret </label>
              <input type='password' name='password'>
              <div class='g-recaptcha' data-sitekey=".CLIENT_KEY."></div>
            </p>
            <p>
              <button>Soumettre</button>
            </p>
          </form>
        </div>
  
      </div>
      <div>
        <img src='../images/lampadaire.png'>
      </div>
    </div>
  
    </div>
    ") ;
    }

////////////////////////////////////////////////////////////////////////

/* 
Password Generator
from https://thisinterestsme.com/php-random-password/
*/
    public static function generatePassword($length){

      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!-.[]?*()';
      $password = '';

      $characterListLength = mb_strlen($characters, '8bit') - 1;
      foreach(range(1, $length) as $i){
          $password .= $characters[random_int(0, $characterListLength)];
      }
      return $password;
    }


  // FOR BDD /////////////////////////////////////////////

    private static function tableExists($pdo, $table) {

      // Try a select statement against the table
      // Run it in try-catch in case PDO is in ERRMODE_EXCEPTION.
      try {
          $result = $pdo->query("SELECT 1 FROM {$table} LIMIT 1");
      } catch (Exception $e) {
          // We got an exception (table not found)
          return FALSE;
      }
  
      // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
      return $result !== FALSE;
  }

    static function bddExists($pdo) {

      $table = ["tbl_actions","tbl_owner", "tbl_careers", "tbl_articles", "tbl_projects", "tbl_contacts"] ;

      foreach($table as $key => $value) {
        if (!self::tableExists($pdo, $value)) {
          return false; 
        }
      }
      return true; 
    }
      
  }

  ////////////////////////////////////////////////////////
