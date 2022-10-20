<?php

class Owner {
    private $tableName = "tbl_owner" ;
    private $pdo ; 

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    function __destruct()
    {
        $this->pdo = null ;
    }

    public function IsDefaultProfilePath() {
        if ($this->GetProfilePath() == "presentation/portrait.png") {
            return true ;
        }
        else {
            return false ; 
        }
    }

    public function GetProfilePath() {
        $stmt = $this->pdo->prepare("SELECT profilPath FROM $this->tableName WHERE 1 ; ") ;
        $stmt->execute() ;

        return $stmt->fetch()["profilPath"] ;
    }

    public function SetProfilePath($path) {
        $stmt = $this->pdo->prepare("UPDATE $this->tableName SET profilPath = ".$this->pdo->quote($path)." ; ") ;
        $stmt->execute();

    }

    public function ActiveCheckQRCode() {
        $stmt = $this->pdo->prepare("UPDATE $this->tableName SET qrcodeCheck = 1 WHERE 1  ;") ;
        $stmt->execute() ;
    }

    public function CheckQRCode() {
        $stmt = $this->pdo->prepare("SELECT qrcodeCheck FROM $this->tableName WHERE 1 ;") ;
        $stmt->execute() ;
        $res =  $stmt->fetch() ;

        if ($res[0] == 1) {
            return true ;
        }
        return false ; 
    }

    public function GetQRSecret() {
        $stmt = $this->pdo->prepare("SELECT secretQrCode FROM tbl_owner WHERE 1 ; ") ;
        $stmt->execute() ;

        return $stmt->fetch()["secretQrCode"] ;
    }

    public function CheckMail() {
        $stmt = $this->pdo->prepare("SELECT qrcodeCheck FROM $this->tableName WHERE 1 ;") ;
        $stmt->execute() ; 
        if ($stmt->fetch()) {
            return true ;
        }
        return false ; 
    }
}