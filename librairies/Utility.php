<?php


class Utility {


  public static function ExtractHTMLFromMarkDownFile($pdo, $champ) {
    $Parsedown = new Parsedown();
    
    $stmt = $pdo->prepare("SELECT `$champ` FROM `primaryData_tbl` WHERE 1;");
    $stmt->execute();
    $path = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($Parsedown->text(file_get_contents($path[$champ]))) ; 
  }


  public static function getValueOfPrimaryData($pdo, $champ) {
    $stmt = $pdo->prepare("SELECT `$champ` FROM `primaryData_tbl` WHERE 1;");
    $stmt->execute();
    $path = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $path[$champ] ;
  }
    
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
      return ('  <div class="blocv2">
      <div class="formConnection">
  
        <div class="contact-form">
  
          <form action="" method="POST">
            <h1>Page de connexion</h1>
  
            <p>
              <label>Code Secret </label>
              <input type="text" name="password">
            </p>
            <p>
              <button>Soumettre</button>
            </p>
          </form>
        </div>
  
      </div>
      <div>
        <img src="../images/lampadaire.png">
      </div>
    </div>
  
    </div>
    ') ;
    }

// found in https://thisinterestsme.com/php-random-password/
    public static function generatePassword($length){

      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!-.[]?*()';
      $password = '';

      $characterListLength = mb_strlen($characters, '8bit') - 1;
      foreach(range(1, $length) as $i){
          $password .= $characters[random_int(0, $characterListLength)];
      }
      return $password;
    }

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
      $table = ["primaryData_tbl","project_tbl", "article_tbl", "career_tbl"] ;
      foreach($table as $key => $value) {
        if (!self::tableExists($pdo, $value)) {
          return false; 
        }
      }
      return true; 
    }
      
  }
