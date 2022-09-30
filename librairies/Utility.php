<?php

class Utility
{

  // PATH LIST ////////////////////////////////////

  const PROFILE_PATH = "presentation/portrait.png";
  const SUMMARY_PATH = "presentation/summary.md";
  const LIBELLE_PORTRAIT_PATH = "presentation/libellePortrait.md";
  const CLOSING_MESSAGE_PATH = "presentation/closing_message.md";

  /////////////////////////////////////////////////


  const TABLES_NAME = ["tbl_actions", "tbl_owner", "tbl_careers", "tbl_articles", "tbl_projects", "tbl_contacts"];



  // LOGS METHODS ////////////////////////////////////

  public static function addlog($pdo, $code)
  {

    $query = "INSERT INTO tbl_logs(horodatage, addr_ip, user_agent, actionid_fk) VALUES(NOW(),'" . $_SERVER['REMOTE_ADDR'] . "','" . $_SERVER['HTTP_USER_AGENT'] . "', $code) ;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $stmt->closeCursor();
  }

  public static function getlogs($pdo)
  {
    $query = "SELECT horodatage, addr_ip, user_agent, actionid_fk FROM tbl_logs ORDER BY horodatage DESC ;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
  }

  ///////////////////////////////////////////////////




  //// INSERT, UPDATE AND DELETE QUERY METHODS //////////////////////////////////



  public static function getNumberOfVisitors($pdo) {
    $query = "SELECT COUNT(*) FROM tbl_logs WHERE actionid_fk = 4; " ;
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt->fetch(); 
  }


  public static function addNewArticle($pdo, $articleTitle) 
  {
  //  $query = "INSERT INTO tbl_articles(title, publicationDate) VALUES(".$pdo->quote($articleTitle).", NOW()) ;" ; 

  $stmt = $pdo->prepare("INSERT INTO tbl_articles(title, publicationDate, fullTextOfArticles) VALUES(".$pdo->quote($articleTitle).", NOW(), 'hello');") ;
  $stmt->execute();
  }

  public static function addNewProject($pdo, $projectName, $pictureName)
  {
    $query = "INSERT INTO tbl_projects(title, photoName, fullTextOfProject) VALUES (" . $pdo->quote($projectName) . ", " . $pdo->quote($pictureName) . ", 'Hello World : D')";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
  }

  public static function editProjects($pdo, $projectTitle, $projectText)
  {
    $query = "UPDATE tbl_projects SET title = " . $pdo->quote($projectTitle) . ", fullTextOfProject = " . $pdo->quote($projectText) . " WHERE title = " . $pdo->quote($projectTitle) . ";";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
  }

  public static function deleteData($pdo, $title, $tbl)
  {
    if ( $tbl == "tbl_projects" ) {
      $imgName = self::getData($pdo, $title, "tbl_projects")[0]["photoName"];
      if (!unlink(__DIR__."/upload/$imgName")) {
        return false ; 
      }
    }
      $stmt = $pdo->prepare("DELETE FROM $tbl WHERE title = " . $pdo->quote($title) . " ; ");
      $stmt->execute();
      return true;

  }

  //////////////////////////////////////////////////////





  public static function ExtractHTMLFromMarkDownFile($pdo, $champ)
  {

    $Parsedown = new Parsedown();

    $stmt = $pdo->prepare("SELECT `$champ` FROM `tbl_owner` WHERE 1;");
    $stmt->execute();
    $path = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($Parsedown->text(file_get_contents($path[$champ])));
  }


  // INTERROGATION METHODS ////////////////////////////////////



  public static function IsValidPassword($pdo, $password)
  {
    $stmt = $pdo->prepare("SELECT secretCode FROM tbl_owner WHERE 1;");
    $stmt->execute();
    $validHachedPassword = $stmt->fetch(PDO::FETCH_ASSOC);
    $hashedPassword = hash('sha256', $password);


    if ($validHachedPassword["secretCode"] == $hashedPassword) {
      return true;
    } else {
      return false;
    }
  }



  public static function lastSuccessfulConnection($pdo, $ip)
  {

    $query = "SELECT horodatage FROM tbl_logs WHERE addr_ip='$ip' AND actionid_fk=3 ;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result["horodatage"];
  }


  public static function potentiallyBruteForceAttack($pdo, $ip)
  {

    $date = $pdo->quote(Utility::lastSuccessfulConnection($pdo, $_SERVER['REMOTE_ADDR']));
    $query = "SELECT COUNT(*) FROM tbl_logs
    WHERE actionid_fk=2 AND horodatage BETWEEN $date AND CONCAT(YEAR(CURDATE()),'-',MONTH(CURDATE()) ,'-', DAY(CURDATE()),' 23:59:59') AND addr_ip='$ip';";


    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result["COUNT(*)"] > 10) {
      return true;
    } else {
      return false;
    }
  }


  public static function getNumberOfItem($pdo, $table)
  {


    $stmt = $pdo->prepare("SELECT COUNT(*) FROM $table ;");
    $stmt->execute();
    $path = $stmt->fetch(PDO::FETCH_ASSOC);

    return $path["COUNT(*)"];
  }

  public static function tableIsEmpty($pdo, $table)
  {
    if (Utility::getNumberOfItem($pdo, $table) < 1) {
      return true;
    } else {
      return false;
    }
  }

  //////// PROFIL REQUEST ///////////////////////////////

  public static function changeHashPassword($pdo, $hash) {
    $stmt = $pdo->prepare("UPDATE tbl_owner SET secretCode = ".$pdo->quote($hash)." ; ");
    $stmt->execute();
  }

  public static function getOwnerData($pdo, $champ)
  {
    $stmt = $pdo->prepare("SELECT `$champ` FROM `tbl_owner` WHERE 1;");
    $stmt->execute();
    $path = $stmt->fetch(PDO::FETCH_ASSOC);

    return $path[$champ];
  }


  public static function setOwnerData($pdo, $lastName, $firstName, $nameOfWebsite, $websiteSubtitle)
  {

    $stmt = $pdo->prepare("UPDATE `tbl_owner` SET `lastName`=" . $pdo->quote($lastName) . ",`surName`=" . $pdo->quote($firstName) . ",`nameOfWebsite`=" . $pdo->quote($nameOfWebsite) . ",`websiteSubtitble`=" . $pdo->quote($websiteSubtitle) . " WHERE 1 ;");
    $stmt->execute();
  }


  

  //// PROJECT REQUEST ///////////////////////////////////
  public static function getAllNames($pdo, $table)
  {
    $stmt = $pdo->prepare("SELECT title FROM $table ;");
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $resultat;
  }


  public static function getData($pdo, $title, $tbl)
  {

    if (in_array($tbl, self::TABLES_NAME)) {

      $stmt = $pdo->prepare("SELECT * FROM $tbl WHERE title=" . $pdo->quote($title) . " ;");
      $stmt->execute();
      $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $resultat;

    }

    
  }

  public static function getAllData($pdo, $tbl)
  {

    if (in_array($tbl, self::TABLES_NAME)) {
    $stmt = $pdo->prepare("SELECT * FROM $tbl ;");
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $resultat;
    }
  }

  ////////////////////////////////////////////////////////

  // RECURRING HTML (PATTERN) ////////////////////////////////////

  public static function getFooter()
  {
    return "<div>
        <footer>
           <a href='index.php' aria-current='page'>Remonter en haut de la page</a> 
        </footer>
    </div>";
  }

  public static function getHeader($listOfCategory, $titleOfWebsite, $subtitleOfWebsite)
  {

    $str = "";
    foreach ($listOfCategory as $key => $value) {
      $str = $str . ("<a  href='" . $value . "' class='nav-link' aria-current='page'>" . $key . "</a>\n");
    }
    return "<header>
    <form method='post' action=''>
        <div id='head'>
          <h1 id='titre'>" . $titleOfWebsite . "</h1><br>
          <b><p id='subtitle'>" . $subtitleOfWebsite . "</p></b>
        </div>
        <div class='js'>
        <div class='language-selector__container'>
        <label>
         <select name='lang' class='labelOfLang' onchange='this.form.submit()'>
         <option value='selected'>Langue</option>
          <option value='en'>en</option>
           <option value'fr'>fr</option>
         </select>
       </label>
     </div>
     </form>
      </header>
      
      <nav class='navPortfolio'>" . $str . "
      
      </nav>";
  }

  static function displayPreviewProject($name, $imgPath)
  {

    echo ("
      <form action='projet.php' method='POST'>
      <input style='display: none;' name='titleOfProjet' value='$name'></input>
      <a onclick='this.parentNode.submit()' >
                    <figure class='wp-caption'>
                        <img  style='margin-bottom: 2vh;' class='previewProject' id='element' src='" . $imgPath . "' alt='Image'/>
                        <figcaption class='wp-caption-text'>" . $name . "</figcaption>
                    </figure>
                </a>
              </form>
      ");
  }

  static function getInstallMessages($pass)
  {

    return (" <h1>Le site a correctement été installé sur le serveur</h1>
        <p>Le mot de passe administrateur est " . $pass . " .</p>
        <p>Il a été envoyée a l'adresse email configurée</p>
        ");
  }

  static function getProjectPage($listOfCategory, $projectTitle, $projectText, $imgPath)
  {
    return (Utility::getHeader($listOfCategory, $projectTitle, "") . "
      ");
  }

  static function getLoginPage($clientKey, $translation)
  {
    return ("
    <div class='blocv2'>
      <div class='formConnection'>
        <div class='contact-form'>
          <form action='' method='POST'>
              <label>" . $translation["admin"]["secretCode"] . " </label>
              <input minlength='16' maxlength='256' style='margin-bottom: 2.5vh;' type='password' name='password' required>
              <div class='g-recaptcha' data-sitekey=$clientKey></div>
            </p>
            <a href='resetPassword.php'>" . $translation["admin"]["forgotPassword"] . "</a>
            <p>
              <button>" . $translation["submit"] . "</button>
            </p>
          </form>
        </div>
      </div>
      <div>
        <img src='../assets/login.png'>
      </div>
    </div>

    </div>
    ");
  }

  static function getResetPasswordPage($clientKey, $translation)
  {


    return ("
      <div class='blocv2'>
  
        <div class='formConnection'>
    
          <div class='contact-form'>
    
            <form action='' method='POST'>
                <label>" . $translation["email"] . " </label>
                <input style='margin-bottom: 2.5vh;' type='email' name='attempt_email' required>
                <div class='g-recaptcha' data-sitekey=$clientKey></div>
              </p>
              <p>
                <button>" . $translation["submit"] . "</button>
              </p>
            </form>
          </div>
    
        </div>
        <div>
        <img src='../assets/login.png'>
        </div>
      </div>
      </div>
      ");
  }

  ////////////////////////////////////////////////////////////////////////

  /* 
Password Generator
from https://thisinterestsme.com/php-random-password/
*/
  public static function generatePassword($length)
  {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!-.[]?*()';
    $password = '';

    $characterListLength = mb_strlen($characters, '8bit') - 1;
    foreach (range(1, $length) as $i) {
      $password .= $characters[random_int(0, $characterListLength)];
    }
    return $password;
  }


  // FOR BDD /////////////////////////////////////////////

  private static function tableExists($pdo, $table)
  {

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

  static function bddExists($pdo)
  {
    foreach (self::TABLES_NAME as $key => $value) {
      if (!self::tableExists($pdo, $value)) {
        return false;
      }
    }
    return true;
  }
}

  ////////////////////////////////////////////////////////
