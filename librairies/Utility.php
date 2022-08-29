<?php

class Utility {
    
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

    static function getInstallMessages($IsInstalled, $pass) {

      if ($IsInstalled) return (" <h1>Le site a correctement été installé sur le serveur</h1>
        <p>Le mot de passe administrateur est ".$pass." .</p>
        <p>Il a été envoyée a l'adresse email configurée</p>
        ") ; 
      else return ("<h1>L'installation du site est un échec </h1> ");

     
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
