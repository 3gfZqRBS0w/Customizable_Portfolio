<?php
class Logs {
    private $pdo ;
    private $tableName = "tbl_logs";

    public function __construct($pdo) {
        $this->pdo = $pdo; 
    }

    function __destruct()
    {
        $this->pdo = null ;
    }


    public function AddLog($code) {
        $stmt = $this->pdo->prepare("INSERT INTO $this->tableName(timestamp, ipAddress, userAgent, actionid_fk) VALUES(NOW(),'" . $_SERVER['REMOTE_ADDR'] . "','" . $_SERVER['HTTP_USER_AGENT'] . "', $code) ;");
        $stmt->execute();

        return $this->pdo->lastInsertId() ; 



       //$stmt->closeCursor();

    }

    public function GetLogs() {
        $stmt = $this->pdo->prepare("SELECT * FROM ".$this->tableName." ORDER BY timestamp DESC ;");
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function GetNumberOfVisitors() {
      $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM ".$this->tableName." WHERE actionid_fk = 4 ;  ") ;
      $stmt->execute();
      $resultat = $stmt->fetch() ;

      return $resultat["COUNT(*)"] ;
    }

    public function MaxVisitPerIP($ip) { 

      $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM ".$this->tableName." WHERE DATE(timestamp) = CURRENT_DATE AND ipAddress='$ip' AND actionid_fk=4;");
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result["COUNT(*)"] < 8 ) {
        return true;
      } else {
        return false;
      }
    }


    // Brute force protection


  private function GetLastSuccessfulConnection($ip)
  {
    $stmt = $this->pdo->prepare("SELECT timestamp FROM ".$this->tableName." WHERE ipAddress='$ip' AND actionid_fk=3 ;");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)["timestamp"];
  }


    public function IsPotentiallyBruteForceAttack($ip)
    {
      $date = $this->pdo->quote($this->GetLastSuccessfulConnection($_SERVER['REMOTE_ADDR']));
      
      $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM tbl_logs
      WHERE actionid_fk=2 AND DATE(timestamp) = CURRENT_DATE AND ipAddress='$ip';");
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
  
      if ($result["COUNT(*)"] > 10 ) {
        return true;
      } else {
        return false;
      }
    }

    public function IsPotentiallyBruteForceAttackForContactForm($ip) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM tbl_logs WHERE actionid_fk=27 AND DATE(timestamp) = CURRENT_DATE AND ipAddress='$ip' ;  ") ;
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if  ($result["COUNT(*)"] <= 3 ) {
            return true;
          } else {
            return false;
          }
    }
}

