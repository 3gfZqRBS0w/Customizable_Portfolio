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
        $stmt = $this->pdo->prepare("INSERT INTO $this->tableName(horodatage, addr_ip, user_agent, actionid_fk) VALUES(NOW(),'" . $_SERVER['REMOTE_ADDR'] . "','" . $_SERVER['HTTP_USER_AGENT'] . "', $code) ;");
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function GetLogs() {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_logs ORDER BY horodatage DESC ;");
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }
}